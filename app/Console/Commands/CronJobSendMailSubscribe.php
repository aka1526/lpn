<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admins\MailsetupController;
use App\Models\Admins\Mailsends;
use App\Models\Admins\Mailsetups;
use App\Models\Admins\Newsletters;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\PHPMailer;

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
        $Newsletters = Newsletters::where('news_status', '=', 'Y')
        ->where('news_email','!=','')->get();
        foreach ($Newsletters as $email) {
            Mailsends::insert([
                'send_uid' => $this->NewUid()
                , 'send_email' => $email->news_email
                , 'send_uid_subject' => '555'
                , 'send_subject' => '999'
                , 'send_type' => 'Subscribe'
                , 'send_status' => 'N'
                , 'created_by' => 'AUTO'
                , 'updated_by' => 'AUTO'
                , 'created_at' => Carbon::now()
                , 'updated_at' => Carbon::now(),
            ]);

        }

        
        //$this->MailSend('akachai@satangapp.in', 'Test SendSubscribe','Test SendSubscribe');

      $this->info('Successfully sent daily quote to everyone.');
    }

    public function MailSend($to = '',$Subject='',$msgBody='')
    {

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
            $mail->Subject = "Test mail MailSendSubscribe";
            $mail->msgHTML("Test mail MailSendSubscribe");

            if (!$mail->send()) {
                $success = false;
            } else {
                $success = true;

            }
       

        return 0;

    }
}
