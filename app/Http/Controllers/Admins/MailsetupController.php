<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cookie;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Admins\User;
use App\Models\Admins\Accessuid;
use App\Models\Admins\Pageheader;

use Image;
use File;

use App\Models\Admins\Mailsetups;
use PHPMailer\PHPMailer\PHPMailer;  
use PHPMailer\PHPMailer\Exception;  
use App\Models\Admins\Mailsubscribe;


class MailsetupController extends Controller
{
    protected  $paging = 5;
    protected  $useruid = '';
    protected $username = '';
    
    public function GetUserUid(){
   
        $loginuid =  Cookie::get('loginuid') !=''  ?  Cookie::get('loginuid') : '';
        $useruid=''; 
        $Accessuid=0;
        $Accessuid = Accessuid::where('uid_login', '=',$loginuid)->count();
        if($Accessuid>0){
            $user = User::where('uid_login', '=',$loginuid)
            ->where('user_status','=','Y')->first();
            
        } else {
            Cookie::queue(Cookie::forget('loginuid'));
            
        }
      
        $useruid = isset($user->uid) ? $user->uid :'';
        $this->username = isset($user->uid) ? $user->name : '';
        
         return $useruid ;
        }

    public function NewUid()
    {
        $uuid = (string) Str::uuid();
        $uuid = str_replace("-", "", $uuid);
        return $uuid;
    }
 
    public function index(Request $request)
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        
        $search =  $request->search;
        $Mailsetups = Mailsetups::where('mail_uid', '!=', '')
        ->where(function ($query) use ($search) {
                if ($search != '') {
                    $query->orwhere('email_address', 'like', '%' . $search . '%');
                    $query->orwhere('email_from_alia', 'like', '%' . $search . '%');
                    $query->orwhere('email_from', 'like', '%' . $search . '%');
                }
        })->orderBy('mail_index')->paginate($this->paging);


        return view('admins.pages.mailsetups.index', compact('Mailsetups'));  
    }


    public function new(Request $request)
    {
       // dd($request);
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

    //   $NewsCatalog= NewsCatalog::where('catalog_status','Y')->orderBy('catalog_index')->get();

        return view('admins.pages.mailsetups.new');  
    }

    public function add(Request $request)
    {
        
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }
       //dd($request);
        $fields = $request->validate(
            [

                'email_address' => 'required|string|unique:news,news_toppic',
                
               
            ],
            [
                'email_address.required' => 'Toppic Name Is Required ',
                'email_address.unique' => 'Toppic Name Is Duplicate ',
                  ]
        );

        $uid =   $this->NewUid();
 
        $index= Mailsetups::max('mail_index')+1;   
        $action = Mailsetups::insert([
            "mail_uid" => $uid
            ,"mail_index" =>  $index
            , "email_from" => $request->email_from
            ,"email_from_alia" => $request->email_from_alia
            ,"email_address" => $request->email_address
            , "email_password" => $request->email_password
            , "smtp_host" => $request->smtp_host
            , "smtp_port" => $request->smtp_port
            , "smtp_secure" => $request->smtp_secure
            , "smtp_auth" => $request->smtp_auth
            ,"email_status" =>"Y"
            , 'created_at' => Carbon::now()
            , 'updated_at' => Carbon::now()
          

        ]);
        
         
      return redirect()->route('mailsetup.index') ;  
    }

    public function get(Request $request,$uid='')
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
   
          if($uid!='') {
            $Mailsetups = Mailsetups::where('mail_uid', '=',$uid)->first();
          }
    
        return view('admins.pages.mailsetups.edit', compact('Mailsetups'));
    }

    public function update(Request $request )
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }

          $uid = $request->mail_uid;
        
          if($uid!='') {
            $action = Mailsetups::where('mail_uid','=',$uid)->update([
               "email_from" => $request->email_from
                ,"email_from_alia" => $request->email_from_alia
                ,"email_address" => $request->email_address
                , "email_password" => $request->email_password
                , "smtp_host" => $request->smtp_host
                , "smtp_port" => $request->smtp_port
                , "smtp_secure" => $request->smtp_secure
                , "smtp_auth" => $request->smtp_auth
                ,"email_status" =>"Y"
                , 'created_at' => Carbon::now()
      
            ]);
            
          }
  
          return redirect()->route('mailsetup.index') ;  
    }
     

    public function delete(Request $request )
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
          
          $uid = $request->uid;
          $action=false;
          $message="fail";
          
          if($uid!='') {
            $action = Mailsetups::where('mail_uid','=',$uid)->delete();
            $message="success";
            
          }
       
          return response()->json(['success' => $action, 'message' => $message  ], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
          //return redirect()->route('news.index') ;  
    }
     
 
 
 public function status(Request $request)
 {
     if( $this->GetUserUid()==''){
         return  redirect(url('/pageadmin/adminlogin'))  ; 
       }
      
     $uid =  $request->uid;
     $status =  $request->status;
     $course = Mailsetups::where('mail_uid', '=', $uid)->first();
     $course_total= 0;
     $success = false;
     $message = 'fail';
     $response = [];
     if ($course) {
         $success = true;
          $message = 'success';
         $success =  Mailsetups::where('mail_uid', '=', $uid)->update([
             "email_status"=> $status
         ]);
         $response = [
             "success" =>  $success,
         ];
        
     }
     
     return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
 }

 public function MailSendTest(Request $request ){     
        $uid =  $request->uid;
        // dd($uid);
        $Mailsetups = Mailsetups::where('mail_uid', '=',$uid)->first();
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host =$Mailsetups->smtp_host;//"mail.satangapp.in";// "mail.krumuaythai.or.th";
        //Set the SMTP port number - likely to be 25, 465 or 587
        $mail->Port = $Mailsetups->smtp_port;//587; 
        
        $mail->SMTPAutoTLS = false;
        $mail->SMTPSecure = true;
        //$mail->SMTPSecure = 'tls';
        if($Mailsetups->smtp_auth=="true"){
            $mail->SMTPAuth = true;
        } else {
            $mail->SMTPAuth = false;
        }
    
        $mail->Username =$Mailsetups->email_address;// "akachai@satangapp.in";//"noreply@krumuaythai.or.th";
        $mail->Password =$Mailsetups->email_password;//'$t2q51Ap';// "Nm5ULoEI@#%2528587";
        $mail->setFrom("$Mailsetups->email_from","$Mailsetups->email_from_alia");
        $mail->AddAddress("$Mailsetups->email_address");
        //$mail->AddCC('memberregister@krumuaythai.or.th'); // memberregister@krumuaythai.or.th pwd=VZAAXzMOl
        //$mail->addBcc('memberregister@krumuaythai.or.th');
        $mail->Subject = "Test mail";
        $mail->msgHTML("Test mail");
        
        if (!$mail->send()) {
            $success = false;
        } else {
            $success =true;
            
        }	

    return response()->json(['success' => $success], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

    }
   
    public function MailSendSubscribe( $uid='',$to=''){     
      //  $uid =  $request->uid;
        // dd($uid);
        $Mailsetups = Mailsetups::where('mail_uid', '=',$uid)->first();
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host =$Mailsetups->smtp_host;//"mail.satangapp.in";// "mail.krumuaythai.or.th";
        //Set the SMTP port number - likely to be 25, 465 or 587
        $mail->Port = $Mailsetups->smtp_port;//587; 
        
        $mail->SMTPAutoTLS = false;
        $mail->SMTPSecure = true;
        //$mail->SMTPSecure = 'tls';
        if($Mailsetups->smtp_auth=="true"){
            $mail->SMTPAuth = true;
        } else {
            $mail->SMTPAuth = false;
        }
    
        $mail->Username =$Mailsetups->email_address;// "akachai@satangapp.in";//"noreply@krumuaythai.or.th";
        $mail->Password =$Mailsetups->email_password;//'$t2q51Ap';// "Nm5ULoEI@#%2528587";
        $mail->setFrom("$Mailsetups->email_from","$Mailsetups->email_from_alia");
        $mail->AddAddress("$Mailsetups->email_address");
        //$mail->AddCC('memberregister@krumuaythai.or.th'); // memberregister@krumuaythai.or.th pwd=VZAAXzMOl
        //$mail->addBcc('memberregister@krumuaythai.or.th');
        $mail->Subject = "Test mail MailSendSubscribe";
        $mail->msgHTML("Test mail MailSendSubscribe");
        
        if (!$mail->send()) {
            $success = false;
        } else {
            $success =true;
            
        }	
        return $success;
    // return response()->json(['success' => $success], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

    }
    
    public function MailSendSubscribeTest( Request $request){     
        //  $uid =  $request->uid;
        $uid=$request->uid;
        $mailto=$request->mailto;
        $subject =$request->mail_subject;
        $mailbody =$request->msg_subscribe;
          // dd($uid);
          $Mailsetups = Mailsetups::where('email_status', '=','Y')->first();
          $mail = new PHPMailer;
          $mail->isSMTP();
          $mail->SMTPDebug = 0;
          $mail->Debugoutput = 'html';
          $mail->Host =$Mailsetups->smtp_host;//"mail.satangapp.in";// "mail.krumuaythai.or.th";
          //Set the SMTP port number - likely to be 25, 465 or 587
          $mail->Port = $Mailsetups->smtp_port;//587; 
          
          $mail->SMTPAutoTLS = false;
          $mail->SMTPSecure = true;
          //$mail->SMTPSecure = 'tls';
          if($Mailsetups->smtp_auth=="true"){
              $mail->SMTPAuth = true;
          } else {
              $mail->SMTPAuth = false;
          }
      
          $mail->Username =$Mailsetups->email_address;// "akachai@satangapp.in";//"noreply@krumuaythai.or.th";
          $mail->Password =$Mailsetups->email_password;//'$t2q51Ap';// "Nm5ULoEI@#%2528587";
          $mail->setFrom("$Mailsetups->email_from","$Mailsetups->email_from_alia");
          $mail->AddAddress("$mailto");
          //$mail->AddCC('memberregister@krumuaythai.or.th'); // memberregister@krumuaythai.or.th pwd=VZAAXzMOl
          //$mail->addBcc('memberregister@krumuaythai.or.th');
          $mail->Subject = $subject;
          $mail->msgHTML($mailbody);
          
          if (!$mail->send()) {
              $success = false;
          } else {
              $success =true;
              
          }	
          return $success;
      // return response()->json(['success' => $success], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
  
      }
      

    public function subscribe_index(Request $request)
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        
        $search =  $request->search;
        $Mailsubscribe = Mailsubscribe::where('email_uid', '!=', '')
        ->orderBy('email_date_start','desc')->orderBy('updated_at','desc')->paginate($this->paging);
        $msgsubscribe=null;
       if($search !=''){
        $msgsubscribe = Mailsubscribe::where('email_uid', '=',$search)
        ->first();
       }
        
        // ->where(function ($query) use ($search) {
        //         if ($search != '') {
        //             $query->orwhere('email_subject', 'like', '%' . $search . '%');
        //            // $query->orwhere('email_from_alia', 'like', '%' . $search . '%');
        //           //  $query->orwhere('email_from', 'like', '%' . $search . '%');
        //         }
        //}


        return view('admins.pages.mailsubscribe.index', compact('Mailsubscribe','msgsubscribe'));  
    }
 
    
    public function subscribe_add(Request $request )
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
          
          $fields = $request->validate(
            [

                'mail_subject' => 'required',
                'msg_subscribe' => 'required',
                'start_date' => 'required',
                
               
            ],
            [
                'mail_subject.required' => 'Subject Is Required ',
              // 'email_address.unique' => 'Toppic Name Is Duplicate ',
                'msg_subscribe.required' => 'Mail Connent Is Required ',
                'start_date.required' => 'Start Date Is Required ',
                  ]
        );
       // dd('dsfsd');
       if($request->email_uid !=''){
        $uid =   $request->email_uid ;
        $action=false;
        
            $action = Mailsubscribe::where('email_uid','=',$uid )->update([

               
                 'email_subject'=> $request->mail_subject
                , 'email_body'=> $request->msg_subscribe
                , 'email_date_start'=> $request->start_date
                , 'updated_by'=> $this->username 
                , 'updated_at'=> Carbon::now()

               
            ]);
       } else {
        $uid =   $this->NewUid() ;
        $action=false;
        
            $action = Mailsubscribe::insert([

                'email_uid'=>  $uid 
                , 'email_subject'=> $request->mail_subject
                , 'email_body'=> $request->msg_subscribe
                , 'email_status'=> "N"
                , 'email_date_start'=> $request->start_date
                , 'created_by'=> $this->username 
                , 'updated_by'=> $this->username 
                , 'created_at'=> Carbon::now()
                , 'updated_at'=> Carbon::now()

               
            ]);
        
       }
       
            
         
 return redirect()->back();
          //return response()->json(['success' => $action], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

    }
     
    public function Subscribestatus(Request $request )
    {

        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
          
            $uid =   $request->uid ;
            $status =   $request->status ;
            $action=false;
          
            $action = Mailsubscribe::where('email_uid','=',$uid )->update([
                'email_status' => $status 
            ]);

     return response()->json(['success' => $action], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);


    }

    public function Subscribedelete(Request $request )
    {

        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
          
            $uid =   $request->uid ;
            
            $action=false;
          
            $action = Mailsubscribe::where('email_uid','=',$uid )->delete();

     return response()->json(['success' => $action], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);


    }
    
   
    


}
