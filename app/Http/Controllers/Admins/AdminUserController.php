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

use App\Models\Admins\Members;
use App\Models\Admins\Khans;
//use App\Http\Controllers\Admins\CheckLoginController;

class AdminUserController extends Controller
{
    protected  $paging = 10;
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
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
         $userAdmin= $this->username  ;
         $totalMember =Members::where('member_status','Y')->count();
         $totalMemberActive =Members::where('member_status','Y')->where('date_expiry','>',Carbon::now())->count();   
         $totalMemberExp =Members::where('member_status','Y')->where('date_expiry','<=',Carbon::now())->count();   
         $user_member =Members::where('member_status','Y')->where('user_type','=','MEMBERS')->count();    
         $user_students =Members::where('member_status','Y')->where('user_type','=','STUDENTS')->count(); 
         $user_teachers =Members::where('member_status','Y')->where('user_type','=','TEACHERS')->count(); 
         $user = User::where('name', '!=', '')->orderBy('created_at')->paginate($this->paging);

        

         $user_countries =Members::select(DB::raw('count(*) as user_count,country_code,min(country_name)country_name'))
            ->where('member_status','Y') 
            ->groupBy('country_code')
            ->orderby('user_count','desc')
            ->take(10)
            ->get(); 
             

//             $latestPosts = DB::table('posts')
//                    ->select('user_id', DB::raw('MAX(created_at) as last_post_created_at'))
//                    ->where('is_published', true)
//                    ->groupBy('user_id');

// $users = DB::table('users')
//         ->joinSub($latestPosts, 'latest_posts', function ($join) {
//             $join->on('users.id', '=', 'latest_posts.user_id');
//         })->get();

      $_students =Members::select(DB::raw('count(*) as user_count,khan_uid'))->where('member_status','Y')
      ->where('user_type','=','STUDENTS')->groupBy('khan_uid'); 
      $khan_students=Khans::where('khan_group','=','STUDENTS')
        ->leftJoinSub($_students, 'members', function ($join) {
              $join->on('khans.khan_uid', '=', 'members.khan_uid');
           })->orderBY('khan_index')->get();

    $_teachers =Members::select(DB::raw('count(*) as user_count,khan_uid'))->where('member_status','Y')
    ->where('user_type','=','TEACHERS')->groupBy('khan_uid'); 
    $khan_teachers=Khans::where('khan_group','=','TEACHERS')
        ->leftJoinSub($_teachers, 'members', function ($join) {
            $join->on('khans.khan_uid', '=', 'members.khan_uid');
        })->orderBY('khan_index')->get();

            
        return view('admins.pages.dashboard.index', compact(
            'user_member','user_students','user_teachers','user_countries','khan_students','khan_teachers',
            'user','userAdmin','totalMember','totalMemberExp','totalMemberActive'));
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
