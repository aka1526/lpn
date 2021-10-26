<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use Cookie;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Admins\User;
use App\Models\Admins\Members;
use App\Models\Admins\Accessuid;
use App\Models\Admins\Country; 
use App\Http\Controllers\Admins\MembersController;
use App\Http\Controllers\Admins\MailsetupController;

class MemberUserController extends Controller
{
    protected  $paging = 10;
    protected  $useruid = '';

    
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
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
   
        $user = User::where('name', '!=', '')->orderBy('created_at')->paginate($this->paging);;
      
        return view('admins.pages.index', compact('user'));
    }

    public function login(Request $request)
    {
        
        $checkstatus=0;
        $loginuid = Cookie::get('loginuid') !='' ? Cookie::get('loginuid') : '';
       
        if($loginuid !=''){
          
            $checkstatus= Members::where('uid_login','=',$loginuid)->count();
            if($checkstatus==0){
                Cookie::queue(Cookie::forget('loginuid'));
                return view('frontend.pages.members.error')->withErrors("Please try to login again.");
              }  
        }
        
        $fields = $request->validate([
            'txtemail' => 'required|string',
            'txtpassword' => 'required|string'
        ]);
       
       
        $Member = Members::where('user_email', $fields['txtemail'])
        ->where('member_status','=','Y')->first();
        //dd(Hash::check(trim($fields['txtpassword']), $Member->password));
      
        if (!$Member || !Hash::check(trim($fields['txtpassword']), $Member->password)) {
            // return response([
            //     'message' => 'Deine hasan'
            // ], 401);
           // dd("No data");
           return view('frontend.pages.members.error')->withErrors("Please try to login again.");
            
        }
       // dd( $Member->user_email);
       // $token = $user->createToken('myapptoken')->plainTextToken;
       $loginuid = $this->NewUid();
       $action = Members::where('member_uid', '=', $Member->member_uid)->update([
        'uid_login' => $loginuid
         ]);

       Accessuid::insert([
            'uid' => $this->NewUid(),
            'uid_login' =>  $loginuid,
            'last_used_at' => Carbon::now()
        ]);

        Cookie::queue('loginuid',$loginuid);
          
        return  redirect(url('/'))  ;
      
    }
    
    public function  register(Request $request) {
      

        $rules = [
            'txtFirstname'    => 'required', 
            'txtemail' => 'required|string|unique:members,user_email',
            'txtpassword' => 'required|string|min:4',
            'txtConfirmPassword' => 'required|min:4|same:txtpassword',
            'txtcountry'    => 'required', 
            'txtgender'    => 'required', 
            
        ];
        $messageerror=[
                    'txtFirstname.required'    => 'First Name Is Required For Your Information ',
                    'txtemail.required'      => 'E-mail Is Required For Your Information',
                    'txtemail.unique'      => 'Sorry, This Email Address Is Already Used By Another User',
                    'txtpassword.required' => 'Password Is Required For Your Information Safety.',
                    'txtpassword.min' => 'Password Is Mininum 4 .',
                    'txtConfirmPassword.same' => 'Password Is not Match.',
                    'txtcountry.required'      => 'Country Is Required For Your Information',
                    'txtgender.required'      => 'Gender Is Required For Your Information',
                ];
    
        $validator = Validator::make($request->all(), $rules, $messageerror);
    
        if ($validator->fails()) {
      
            return view('frontend.pages.members.error')->withErrors($validator);
 
        }  
         
      $uid = $this->NewUid();
      $_date =Carbon::now()->format('Y-m-d');
      $date_register = Carbon::now()->format('Y-m-d');
      $member_year = Carbon::now()->format('Y');
      $member_month = Carbon::now()->format('m');
      $khan_uid ="";

      $country_code = $request->txtcountry;
      $country = Country::where('country_code', '=', $country_code)->first();

      $user_type = "MEMBERS";
      $member_group = "PERSON";
      $max_no = Members::max('max_no') + 1;
   
      $MembersCtl= new MembersController();
      $member_no = $MembersCtl->getIdCard($max_no, 'PLN-' . $member_year);
     // dd($member_no);
        $action = Members::create([
            'member_uid' => $uid 
            ,'first_name' => strtoupper($request->txtFirstname)
            , 'last_name' => strtoupper($request->txtLastname)
            , 'full_name' => strtoupper($request->txtFirstname . ' ' . $request->txtLastname)
            , 'gender' => $request->txtgender
            , 'dateofbirth' => $request->dateofbirth
            , 'country_uid' => $country->country_uid
            , 'country_code' => $country->country_code
            , 'country_name' => $country->country_name
            , 'user_email' => $request->txtemail
            , 'user_type' => $user_type
            , 'created_at' => Carbon::now()
            , 'updated_at' => Carbon::now()
            , 'member_status' => "Y"
            , 'member_group' => $member_group
            , 'date_register' => $date_register
            , 'member_year' => $member_year
            , 'member_month' => $member_month
            , 'member_no' => $member_no
            , 'member_active' => 'Y'
            , 'max_no' => $max_no
            , 'password' =>bcrypt(trim($request->txtpassword))
            
        ]);
        return view('frontend.pages.members.error')->withsuccess("Create user login success .");
       // return  redirect(url('/'))  ; 
    }

    public function logout(Request $request)
    {
         
       // auth()->user()->tokens()->delete();
       $loginuid = Cookie::get('loginuid') !='' ? Cookie::get('loginuid') :'';
       $success = Accessuid::where('uid_login','=',$loginuid)->delete();
            if($success){
                Cookie::queue(Cookie::forget('loginuid'));
                return  redirect(url('/'))  ; 
            }
   
    }

    public function forget(Request $request)
    {
         
        return view('frontend.pages.members.forget');
    }
    
    public function forgetpwd(Request $request)
    {
        $request->validate([
            'txtemail' => 'required|email',
        ]);
         
         $txtemail = $request->txtemail;
         $Member =Members::where('user_email',$txtemail)->first();
        if($Member){
            
            $token = Str::random(64);
                 DB::table('password_resets')->insert([
                'email' => $txtemail, 
                'token' => $token, 
                'member_id' => $Member->member_no,
                'status' => 'N',
                'created_at' => Carbon::now()
              ]);
              
           $MailSend= new MailsetupController;
           $act=  $MailSend->MailSendResetPwd($txtemail,$token);

              $message='We have sent you an email with your a link in order to reset your password';
           return view('frontend.pages.members.checkmail',compact('message','act')) ;
        } else {
            $message='E-mail not find!!!. ';
            $act=false;
            return view('frontend.pages.members.checkmail',compact('message','act')) ;
        }
        
        
    }
    
    public function resetpwdpage(Request $request)
    {
         
        return view('frontend.pages.members.resetpwdpage');
    }
    public function resetpwdurl(Request $request)
    {

        
        $request->validate([
            'keytoken' => 'required',
            'newpassword' => 'required',
            'confirmpassword' => 'required',
        ]);

        $keytoken = $request->keytoken;
        $newpassword = $request->newpassword;
        $update=false;
        $message='Update Password Error.';
        $_count = DB::table('password_resets')->where('token','=',$keytoken )->count();


       $resets = DB::table('password_resets')->where('token','=',$keytoken )
        ->where('status','N')->first();
        if($resets){
            $message='token Password Expire.';
            $update = DB::table('password_resets')->where('token','=',$keytoken )->update([
                'status' => 'Y'
            ]);
            if( $update){
                $message='Update Password success.';
                Members::where('member_no','=',$resets->member_id)->update([
                    'password' => bcrypt(trim($newpassword ))
                ]);
            }
           
        } else {

            if($_count>0){
                $message='token Password Expire.';
            }
        }
        return response()->json(['success' => $update, 'message' =>  $message ], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);  
        
    }
    

    // public function user(Request $request)
    // {
       
    //   //  dd( request()->path());
    //      if( $this->GetUserUid()==''){
    //          return  redirect(url('/pageadmin/adminlogin'))  ; 
    //       }
        
    //     $user = User::where('name', '!=', '')->orderBy('created_at')->paginate($this->paging);;
      
    //     return view('admins.pages.user_all', compact('user'));
    // }

    

    // public function pagelogin(Request $request)
    // {
    //     $loginuid =  $this->useruid ;
    //     $checkstatus=0;
    //     if($loginuid){
    //         $checkstatus= User::where('uid_login','=',$loginuid)->count();
    //     }
    //   if($checkstatus>0){
    //     return  redirect(url('/pageadmin'))  ; 
    //   }
        
    //     return view('admins.pages.admin_login');
    // }
    

    // public function register(Request $request)
    // {
    //     if( $this->GetUserUid()==''){
    //         return  redirect(url('/pageadmin/adminlogin'))  ; 
    //       }

    //     $fields = $request->validate(
    //         [

    //             'name' => 'required|string',
    //             'email' => 'required|string|unique:users,email',
    //             'password' => 'required|string|min:6'
    //         ],
    //         [
    //             'name.required'    => ' Username Is Required For Your Information ',
    //             'email.required'      => 'E-mail Is Required For Your Information',
    //             'email.unique'      => 'Sorry, This Email Address Is Already Used By Another User',
    //             'password.required' => 'Password Is Required For Your Information Safety.',
    //             'password.min'      => 'assword Length Should Be More Than 6 Character',
    //         ]
    //     );


    //     $uid = $this->NewUid();
    //     $user = User::create([
    //         'uid' => $uid,
    //         'is_admin' => 'staff',
    //         'name' => $fields['name'],
    //         'email' => $fields['email'],
    //         'password' => bcrypt($fields['password']),
    //         'created_at' => Carbon::now(),
    //         'updated_at' => Carbon::now()
    //     ]);

    //     $uid_login = $this->NewUid();
    //      $action=  Accessuid::insert([
    //         'uid' => $this->NewUid(),
    //         'uid_login' =>  $uid_login,
    //         'last_used_at' => Carbon::now()
    //     ]);
    //     if($action){
    //         User::where('uid', '=', $uid)->update([
    //             'uid_login' => $uid_login
    //         ]);
    //     }

    //     $response = [
    //         'action' => $action,
    //         'msg' => 'success'
    //     ];

    //     return response($response, 201);
    // }

    // public function login(Request $request)
    // {
    //     $checkstatus=0;
    //     $loginuid = Cookie::get('loginuid') !='' ? Cookie::get('loginuid') :'';
    //     if($loginuid){
    //         $checkstatus= User::where('uid_login','=',$loginuid)->count();
    //     }

    //   if($checkstatus>0){
    //     return  redirect(url('/pageadmin'))  ; 
    //   }
        
        
    //     $fields = $request->validate([
    //         'email' => 'required|string',
    //         'password' => 'required|string'
    //     ]);

      
    //     $user = User::where('email', $fields['email'])
    //     ->where('user_status','=','Y')->first();

         
    //     if (!$user || !Hash::check($fields['password'], $user->password)) {
    //         // return response([
    //         //     'message' => 'Deine hasan'
    //         // ], 401);
    //         return  redirect(url('/pageadmin/adminlogin'))  ; 
    //     }

    //    // $token = $user->createToken('myapptoken')->plainTextToken;
    //    $loginuid = $this->NewUid();
    //    $action = User::where('uid', '=', $user->uid)->update([
    //     'uid_login' => $loginuid
    // ]);

    //    Accessuid::insert([
    //         'uid' => $this->NewUid(),
    //         'uid_login' =>  $loginuid,
    //         'last_used_at' => Carbon::now()
    //     ]);

    //     Cookie::queue('loginuid',$loginuid);
          
    //     return  redirect(url('/pageadmin'))  ;
      
    // }

    // public function adminlogout(Request $request)
    // {
    //    // auth()->user()->tokens()->delete();
    //    $loginuid = Cookie::get('loginuid') !='' ? Cookie::get('loginuid') :'';
    //     if($loginuid){
    //         $checkstatus= User::where('uid_login','=',$loginuid)->count();
    //     }
    //     $success=false;
    //     $message='fail';
    //     if($checkstatus>0){
            
    //         $success = Accessuid::where('uid_login','=',$loginuid)->delete();
    //         if($success){
    //             Cookie::queue(Cookie::forget('loginuid'));
    //             return  redirect(url('/pageadmin/adminlogin'))  ; 
    //         }
          
    //     }
    //   // return response()->json(['success' => $success, 'message' =>  $message], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        
    // }



    // public function getuser(Request $request)
    // {

    //     if( $this->GetUserUid()==''){
    //         return  redirect(url('/pageadmin/adminlogin'))  ; 
    //       }
    //     $uid =  $request->uid;
    //     $user = User::where('uid', '=', $uid)->first();
    //     $success = false;
    //     $message = 'fail';
    //     $response = [];
    //     if ($user) {
    //         $success = true;
    //         $message = 'success';
    //         $response = [
    //             'uid' => $user->uid,
    //             'name' => $user->name,
    //             'email' => $user->email,
    //             'level' => $user->is_admin,
    //         ];
    //     }
    //     return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    // }

    // public function updateuser(Request $request)
    // {
    //     if( $this->GetUserUid()==''){
    //         return  redirect(url('/pageadmin/adminlogin'))  ; 
    //       }

    //     $uid =  $request->_uid;
    //     $user = User::where('uid', '=', $uid)->first();
    //     $success = false;
    //     $message = 'fail';
    //     $response = [];
    //     if ($user) {
    //         $success = true;
    //         $message = 'success';
    //         $success =  User::where('uid', '=', $uid)->update([
    //             'name' => $request->_name, 'email' => $request->_email, 'updated_at' => Carbon::now()
    //         ]);
    //     }
    //     return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    // }



    // public function updatepwd(Request $request)
    // {
    //     if( $this->GetUserUid()==''){
    //         return  redirect(url('/pageadmin/adminlogin'))  ; 
    //       }
    //     $fields = $request->validate(
    //         [
    //             'newpassword' => 'required|string|min:6'
    //         ],
    //         [
    //             'newpassword.required' => 'Password Is Required For Your Information Safety.',
    //             'newpassword.min'      => 'assword Length Should Be More Than 6 Character',
    //         ]
    //     );

    //     $uid =  $request->pwd_uid;
    //     $newpassword =  $request->newpassword;
    //     $user = User::where('uid', '=', $uid)->first();
    //     $success = false;
    //     $message = 'fail';
    //     $response = [];
    //     if ($user) {
    //         $success = true;
          
    //         $message = 'success';
    //         $success =  User::where('uid', '=', $uid)->update([
    //             'password' => bcrypt($newpassword),
    //             'updated_at' => Carbon::now()

    //         ]);
           
    //     }
        
    //     return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    // }


    // public function updatestatus(Request $request)
    // {
    //     if( $this->GetUserUid()==''){
    //         return  redirect(url('/pageadmin/adminlogin'))  ; 
    //       }
       
    //     $uid =  $request->uid;
    //     $user_status =  $request->status;
    //     $user = User::where('uid', '=', $uid)->first();
    //     $success = false;
    //     $message = 'fail';
    //     $response = [];
    //     if ($user) {
    //         $success = true;
          
    //         $message = 'success';
    //         $success =  User::where('uid', '=', $uid)->update([
    //             'user_status' =>  $user_status,
    //             'updated_at' => Carbon::now()

    //         ]);
           
    //     }
        
    //     return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    // }


    // public function userdelete(Request $request)
    // {
    //     if( $this->GetUserUid()==''){
    //         return  redirect(url('/pageadmin/adminlogin'))  ; 
    //       }

    //     $uid =  $request->uid;
         
    //     $user = User::where('uid', '=', $uid)->first();
    //     $success = false;
    //     $message = 'fail';
    //     $response = [];
    //     if ($user) {
    //         $success = true;
          
    //         $message = 'success';
    //         $success =  User::where('uid', '=', $uid)->delete();
           
    //     }
        
    //     return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    // }


    
}
