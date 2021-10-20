<?php

namespace App\Console\Commands;

use App\Models\Admins\Mailsends;
use App\Models\Admins\Mailsetups;
use App\Models\Admins\Mailsubscribe;
use App\Models\Admins\Newsletters;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\PHPMailer;
use DB;
class CronJobSendMailSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'command:name';
    protected $signature = 'SendMailSubscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail to All Subscribe';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function NewUid()
    {
        $uuid = (string) Str::uuid();
        $uuid = str_replace("-", "", $uuid);
        return $uuid;
    }

    public function handle()
    {
        $MailList = Newsletters::where('news_status', '=', 'Y')
            ->where('news_type', '=', 'subscribe')
            ->where('news_email', '!=', '')->get();

        $date_start = Carbon::now()->format('Y-m-d');

        $uid_subject = "";
        $uid_subject_date = "";

        foreach ($MailList as $email) {

            $mailsubscribe = Mailsubscribe::where('email_date_start', '<=', $date_start)
                ->where('email_status', '=', 'Y')->orderBy('updated_at')->get();

            if (count($mailsubscribe) > 0) {

                foreach ($mailsubscribe as $subscribe) {
                    $uid_subject = $subscribe->email_uid;
                    $uid_subject_date = $subscribe->email_date_start;

                    $CountMail = Mailsends::where('send_uid_subject', '=', $uid_subject)
                        ->where('send_subject_date', '=', $uid_subject_date)
                        ->where('send_email', '=', $email->news_email)->count();
                    if ($CountMail == 0) {

                        Mailsends::insert([
                            'send_uid' => $this->NewUid()
                            , 'send_email' => $email->news_email
                            , 'send_uid_subject' => $uid_subject
                            , 'send_subject' => $subscribe->email_subject
                            , 'send_subject_date' => $uid_subject_date
                            , 'send_type' => 'Subscribe'
                            , 'send_status' => 'N'
                            , 'created_by' => 'AUTO'
                            , 'updated_by' => 'AUTO'
                            , 'created_at' => Carbon::now()
                            , 'updated_at' => Carbon::now(),
                        ]);
                    }

                    $email_total = Mailsends::where('send_uid_subject', '=', $uid_subject)
                        ->where('send_subject_date', '=', $uid_subject_date)->count();

                    Mailsubscribe::where('email_date_start', '=', $uid_subject_date)->update([
                        'email_total' => $email_total,

                    ]);

                }

            }

        }

        $mailsubscribe = Mailsubscribe::where('email_date_start', '<=', $date_start)
            ->where('email_status', '=', 'Y')
            ->orderBy('updated_at')->take(1)->get();

        foreach ($mailsubscribe as $subscribe) {

            $uid_subject = $subscribe->email_uid;
            $uid_subject_date = $subscribe->email_date_start;

            $mailto = Mailsends::where('send_uid_subject', '=', $uid_subject)
                ->where('send_subject_date', '=', $uid_subject_date)
                ->where('send_status', '=', 'N')->first();

            $this->info('Successfully  =>' . $uid_subject . ' =>' . $uid_subject_date);
            if (isset($mailto)) {

                $send_uid = $mailto->send_uid;
                $send_to_mail = $mailto->send_email;
                $send_subject = $subscribe->email_subject;
                $send_email_body = $subscribe->email_body;

                $action = $this->MailSend($send_to_mail, $send_subject, $send_email_body);
                if ($action) {

                    Mailsends::where('send_uid', '=', $send_uid)->update([
                        'send_status' => 'Y'
                        , 'updated_at' => Carbon::now(),
                    ]);

                    $email_send_total = Mailsends::where('send_uid_subject', '=', $uid_subject)
                        ->where('send_subject_date', '=', $uid_subject_date)
                        ->where('send_status', '=', 'Y')->count();

                    Mailsubscribe::where('email_uid', '=', $uid_subject)
                        ->where('email_date_start', '=', $uid_subject_date)->update([
                        "email_send_total" => $email_send_total,
                    ]);

                }
                DB::statement(" update mailsubscribe set email_status='N' 
                where email_total=email_send_total and email_send_total>0 ;");
                // Mailsubscribe::where('email_uid','!=','')
                // ->where('email_send_total','>',0)->update([
                //     "email_status" => "N"
                // ]);
                return $action;
            }

        }
        DB::statement(" update mailsubscribe set email_status='N' 
            where email_total=email_send_total and email_send_total>0 ;");

        // Mailsubscribe::where('email_uid','!=','')

        //         ->where('email_send_total','>',0)->update([
        //             "email_status" => "N"
        //         ]);

    }

    public function MailSend($to = '', $Subject = '', $msgBody = '')
    {

        $this->info('Successfully sent daily quote to =>' . $to);
        $Mailsetups = Mailsetups::where('email_status', '=', 'Y')->inRandomOrder()->first();
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = $Mailsetups->smtp_host; //"mail.satangapp.in";// "mail.krumuaythai.or.th";
        //Set the SMTP port number - likely to be 25, 465 or 587
        $mail->Port = $Mailsetups->smtp_port; //587;

        $mail->SMTPAutoTLS = false;
        $mail->SMTPSecure = true;
        //$mail->SMTPSecure = 'tls';
        if ($Mailsetups->smtp_auth == "true") {
            $mail->SMTPAuth = true;
        } else {
            $mail->SMTPAuth = false;
        }

        $mail->Username = $Mailsetups->email_address; // "akachai@satangapp.in";//"noreply@krumuaythai.or.th";
        $mail->Password = $Mailsetups->email_password; //'$t2q51Ap';// "Nm5ULoEI@#%2528587";
        $mail->setFrom("$Mailsetups->email_from", "$Mailsetups->email_from_alia");
        $mail->AddAddress("$to");
        //$mail->AddCC('memberregister@krumuaythai.or.th'); // memberregister@krumuaythai.or.th pwd=VZAAXzMOl
        //$mail->addBcc('memberregister@krumuaythai.or.th');
        $mail->Subject = $Subject;
        $mail->msgHTML($msgBody);

        if (!$mail->send()) {
            $success = false;
        } else {
            $success = true;

        }

        return $success;

    }
}
