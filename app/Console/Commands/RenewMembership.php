<?php

namespace App\Console\Commands;

use App\Models\Admins\Mailsetups;
use App\Models\Admins\Members;
use App\Models\Admins\Sysinfo;
use App\Models\Admins\Mailsends;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\PHPMailer;

class RenewMembership extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Alert:RenewMemberShip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail Alert Befor Exp 30 Days and Expiration day';

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

        $BeforDays = array(30, 7, 1 );

        foreach ($BeforDays as $BeforDay) {

            $Befor_Members = Members::where('member_status', '=', 'Y')
                ->where('user_type', '!=', 'MEMBERS') //STUDENTS and THCHERS
                ->where('user_email', '!=', '')
                ->whereRaw('DATEDIFF(date_expiry,current_date ) = '. $BeforDay)->get();

            $renew = 0;
            $this->info('Start sent Mail RenewBefor =>' . $BeforDay .' Days');
            foreach ($Befor_Members as $member) {

                $user_email = $member->user_email;
                $member_no = $member->member_no;
                $member_name = $member->full_name;
                $send_uid= $member->member_uid;
                $send_subject = 'Mail alert for membership renewal date';

                $action = $this->MailSend($user_email, $send_subject, $this->email_body_Befor30($member_no));
                if ($action) {
                    $renew++;
                    Mailsends::insert([
                        'send_uid' => $this->NewUid()
                        , 'send_email' => $user_email
                        , 'send_uid_subject' => $send_uid
                        , 'send_subject' => $send_subject
                        , 'send_member_no' => $member_no
                        , 'send_member_name' => $member_name
                        , 'send_subject_date' => Carbon::now()->format('Y-m-d')
                        , 'send_type' => 'Renewal'
                        , 'send_status' => 'Y'
                        , 'created_by' => 'AUTO'
                        , 'updated_by' => 'AUTO'
                        , 'created_at' => Carbon::now()
                        , 'updated_at' => Carbon::now(),
                    ]);
                }
            }
            if ($renew > 0) {
                $this->info('Successfully sent Mail RenewBefor =>'. $BeforDay .' Days');
            }

        }

        $ExpDays = array(30, 90, 180, 360, 720); 

        foreach ($ExpDays as $expDate) {

            $OverExp_Members = Members::where('member_status', '=', 'Y')
                ->where('user_type', '!=', 'MEMBERS') //STUDENTS and THCHERS
                ->where('user_email', '!=', '')
                ->whereRaw('DATEDIFF(current_date,date_expiry ) = '. $expDate)->get();
                $this->info('Start sent Mail Over Renew =>' . $expDate .' Days');
            $exp = 0;
            foreach ($OverExp_Members as $member) {

                $user_email = $member->user_email;
                $member_no = $member->member_no;
                $member_name = $member->full_name;
                $send_uid= $member->member_uid;
                $send_subject = 'Mail alert for membership ' . $expDate . ' days past renewal date';

                $action = $this->MailSend($user_email, $send_subject, $this->email_body_Exp_Overday($member_no, $expDate));
                if ($action) {
                    $exp++;
                    Mailsends::insert([
                        'send_uid' => $this->NewUid()
                        , 'send_email' => $user_email
                        , 'send_uid_subject' => $send_uid
                        , 'send_member_no' => $member_no
                        , 'send_member_name' => $member_name
                        , 'send_subject' => $send_subject
                        , 'send_subject_date' => Carbon::now()->format('Y-m-d')
                        , 'send_type' => 'Expire'
                        , 'send_status' => 'Y'
                        , 'created_by' => 'AUTO'
                        , 'updated_by' => 'AUTO'
                        , 'created_at' => Carbon::now()
                        , 'updated_at' => Carbon::now(),
                    ]);
                }
            }
            if ($renew > 0) {
                $this->info('Successfully sent Mail Over Renew =>'. $expDate .' Days');
            }

        }

        return Command::SUCCESS;
    }

    public function email_body_Befor30($member_no)
    {
        $Sysinfo=Sysinfo::where('sys_status','=','Y')->first();
        $member = Members::where('member_no', '=', $member_no)->first();

        $msgBody = "
        <h4>Dear " . $member->full_name . ",</h4><br />
        Your Lumpinee Academy Muaythai membership expires <strong >" . Carbon::parse($member->date_expiry)->format('d F Y') . "</strong>, and we sincerely hope that you will join us for <br />
        another outstanding year of great programs and professional development.
        Good news! There is still time to renew, and  Print and complete the attached form, and mail it in with your payment. <br /><br />

        If your renewal form and payment are received by <strong>" . Carbon::parse($member->date_expiry)->format('d F Y') . "</strong> , you will be entered into a drawing for a <br />
        Membership Details:<br /><br />

        Member No. : <strong>" . $member->member_no . "</strong><br />
        Khan : " . $member->khan_name . "<br />
        Certificate No :<strong> " .($member->certificate_no != '' ? $member->certificate_no : '-') . "</strong><br />
        Signup Date: " . $member->date_register . "<br />
        Expiry Date: " . $member->date_expiry . "<br /><br />

        Please contact  at  ". $Sysinfo->sys_phone1 ." or ".$Sysinfo->sys_email1 ." if you have any questions or if there is anything
        we can do to help.<br /><br /><br />

        Best regards, <br />
        Lumpinee Academy Muaythai ";

        return $msgBody;
    }

    public function email_body_Exp_day($member_no)
    {
        $Sysinfo=Sysinfo::where('sys_status','=','Y')->first();
        $member = Members::where('member_no', '=', $member_no)->first();

        $msgBody = "
        <h4>Dear " . $member->full_name . ",</h4><br />

        It is been a year since we first met you, and we’re looking forward to many more years! Did you know
        that your Lumpinee Academy Muaythai membership expires today?
        Please don it let your membership lapse! There are better options than paying an additional 30 dollar
        amount to attend monthly events as a guest (guest rate is 45 dollar  ) or rejoining at the new
        member rate of 45 dollar.><br />

        Membership Details:<br /><br />

        Member No. : <strong>" . $member->member_no . "</strong><br />
        Khan : " . $member->khan_name . "<br />
        Certificate No :<strong> " . ($member->certificate_no != '' ? $member->certificate_no : '-') . "</strong><br />
        Signup Date: " . $member->date_register . "<br />
        Expiry Date: " . $member->date_expiry . "<br /><br />

        Please contact  at  ". $Sysinfo->sys_phone1 ." or ".$Sysinfo->sys_email1 ." if you have any questions or if there is anything
        we can do to help.<br /><br /><br />

        Best regards, <br />
        Lumpinee Academy Muaythai ";

        return $msgBody;
    }

    public function email_body_Exp_Overday($member_no, $day)
    {
        $Sysinfo=Sysinfo::where('sys_status','=','Y')->first();
        $member = Members::where('member_no', '=', $member_no)->first();

        $msgBody = "
        <h4>Dear " . $member->full_name . ",</h4><br />

        First and foremost, we want to thank you for your membership with Lumpinee Academy Muaythai. According to our
        records, your membership fee is currently " . $day . " days past due, and we don’t want to lose you! We greatly
        value your support, so we’re reaching out one last time to ensure continuation of your membership
        benefits.<br />

        Membership Details:<br /><br />

        Member No. : <strong>" . $member->member_no . "</strong><br />
        Khan : " . $member->khan_name . "<br />
        Certificate No :<strong> " . ($member->certificate_no != '' ? $member->certificate_no : '-') . "</strong><br />
        Signup Date: " . $member->date_register . "<br />
        Expiry Date: " . $member->date_expiry . "<br /><br />

        In order to renew your membership, full payment in the amount of dollar 90 must be received
        within 10 days from the date of this email. If your payment is not received by this date, we will assume
        that you wish to discontinue your membership.<br />

        Please contact  at  ". $Sysinfo->sys_phone1 ." or ".$Sysinfo->sys_email1 ." if you have any questions or if there is anything
        we can do to help.<br /><br /><br />

        Best regards,<br /><br />
        
        Lumpinee Academy Muaythai ";

        return $msgBody;
    }

    public function MailSend($to = '', $Subject = '', $msgBody = '')
    {

        $this->info('------Sent Mail to =>' . $to);
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
