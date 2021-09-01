<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use Cookie;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Admins\User;
use App\Models\Admins\Accessuid;

//use App\Http\Controllers\Admins\CheckLoginController;

class AdminUserController extends Controller
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

    public function user(Request $request)
    {
       
      //  dd( request()->path());
         if( $this->GetUserUid()==''){
             return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
        
        $user = User::where('name', '!=', '')->orderBy('created_at')->paginate($this->paging);;
      
        return view('admins.pages.user_all', compact('user'));
    }

    

    public function pagelogin(Request $request)
    {
        $loginuid =  $this->useruid ;
        $checkstatus=0;
        if($loginuid){
            $checkstatus= User::where('uid_login','=',$loginuid)->count();
        }
      if($checkstatus>0){
        return  redirect(url('/pageadmin'))  ; 
      }
        
        return view('admins.pages.admin_login');
    }
    

    public function register(Request $request)
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }

        $fields = $request->validate(
            [

                'name' => 'required|string',
                'email' => 'required|string|unique:users,email',
                'password' => 'required|string|min:6'
            ],
            [
                'name.required'    => ' Username Is Required For Your Information ',
                'email.required'      => 'E-mail Is Required For Your Information',
                'email.unique'      => 'Sorry, This Email Address Is Already Used By Another User',
                'password.required' => 'Password Is Required For Your Information Safety.',
                'password.min'      => 'assword Length Should Be More Than 6 Character',
            ]
        );


        $uid = $this->NewUid();
        $user = User::create([
            'uid' => $uid,
            'is_admin' => 'staff',
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $uid_login = $this->NewUid();
         $action=  Accessuid::insert([
            'uid' => $this->NewUid(),
            'uid_login' =>  $uid_login,
            'last_used_at' => Carbon::now()
        ]);
        if($action){
            User::where('uid', '=', $uid)->update([
                'uid_login' => $uid_login
            ]);
        }

        $response = [
            'action' => $action,
            'msg' => 'success'
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $checkstatus=0;
        $loginuid = Cookie::get('loginuid') !='' ? Cookie::get('loginuid') :'';
        if($loginuid){
            $checkstatus= User::where('uid_login','=',$loginuid)->count();
        }

      if($checkstatus>0){
        return  redirect(url('/pageadmin'))  ; 
      }
        
        
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

      
        $user = User::where('email', $fields['email'])
        ->where('user_status','=','Y')->first();

         
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            // return response([
            //     'message' => 'Deine hasan'
            // ], 401);
            return  redirect(url('/pageadmin/adminlogin'))  ; 
        }

       // $token = $user->createToken('myapptoken')->plainTextToken;
       $loginuid = $this->NewUid();
       $action = User::where('uid', '=', $user->uid)->update([
        'uid_login' => $loginuid
    ]);

       Accessuid::insert([
            'uid' => $this->NewUid(),
            'uid_login' =>  $loginuid,
            'last_used_at' => Carbon::now()
        ]);

        Cookie::queue('loginuid',$loginuid);
          
        return  redirect(url('/pageadmin'))  ;
      
    }

    public function adminlogout(Request $request)
    {
       // auth()->user()->tokens()->delete();
       $loginuid = Cookie::get('loginuid') !='' ? Cookie::get('loginuid') :'';
        if($loginuid){
            $checkstatus= User::where('uid_login','=',$loginuid)->count();
        }
        $success=false;
        $message='fail';
        if($checkstatus>0){
            
            $success = Accessuid::where('uid_login','=',$loginuid)->delete();
            if($success){
                Cookie::queue(Cookie::forget('loginuid'));
                return  redirect(url('/pageadmin/adminlogin'))  ; 
            }
          
        }
      // return response()->json(['success' => $success, 'message' =>  $message], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        
    }



    public function getuser(Request $request)
    {

        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
        $uid =  $request->uid;
        $user = User::where('uid', '=', $uid)->first();
        $success = false;
        $message = 'fail';
        $response = [];
        if ($user) {
            $success = true;
            $message = 'success';
            $response = [
                'uid' => $user->uid,
                'name' => $user->name,
                'email' => $user->email,
                'level' => $user->is_admin,
            ];
        }
        return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

    public function updateuser(Request $request)
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }

        $uid =  $request->_uid;
        $user = User::where('uid', '=', $uid)->first();
        $success = false;
        $message = 'fail';
        $response = [];
        if ($user) {
            $success = true;
            $message = 'success';
            $success =  User::where('uid', '=', $uid)->update([
                'name' => $request->_name, 'email' => $request->_email, 'updated_at' => Carbon::now()
            ]);
        }
        return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }



    public function updatepwd(Request $request)
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
        $fields = $request->validate(
            [
                'newpassword' => 'required|string|min:6'
            ],
            [
                'newpassword.required' => 'Password Is Required For Your Information Safety.',
                'newpassword.min'      => 'assword Length Should Be More Than 6 Character',
            ]
        );

        $uid =  $request->pwd_uid;
        $newpassword =  $request->newpassword;
        $user = User::where('uid', '=', $uid)->first();
        $success = false;
        $message = 'fail';
        $response = [];
        if ($user) {
            $success = true;
          
            $message = 'success';
            $success =  User::where('uid', '=', $uid)->update([
                'password' => bcrypt($newpassword),
                'updated_at' => Carbon::now()

            ]);
           
        }
        
        return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }


    public function updatestatus(Request $request)
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
       
        $uid =  $request->uid;
        $user_status =  $request->status;
        $user = User::where('uid', '=', $uid)->first();
        $success = false;
        $message = 'fail';
        $response = [];
        if ($user) {
            $success = true;
          
            $message = 'success';
            $success =  User::where('uid', '=', $uid)->update([
                'user_status' =>  $user_status,
                'updated_at' => Carbon::now()

            ]);
           
        }
        
        return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }


    public function userdelete(Request $request)
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }

        $uid =  $request->uid;
         
        $user = User::where('uid', '=', $uid)->first();
        $success = false;
        $message = 'fail';
        $response = [];
        if ($user) {
            $success = true;
          
            $message = 'success';
            $success =  User::where('uid', '=', $uid)->delete();
           
        }
        
        return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }


    
}
