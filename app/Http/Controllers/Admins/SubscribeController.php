<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;

use App\Models\Admins\Accessuid;
use App\Models\Admins\User;
use Carbon\Carbon;
use Cookie;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use App\Models\Admins\Newsletters;

class SubscribeController extends Controller
{
    protected $paging = 10;
    protected $useruid = '';

    public function GetUserUid()
    {

        $loginuid = Cookie::get('loginuid') != '' ? Cookie::get('loginuid') : '';
        $useruid = '';
        $Accessuid = 0;
        $Accessuid = Accessuid::where('uid_login', '=', $loginuid)->count();
        if ($Accessuid > 0) {
            $user = User::where('uid_login', '=', $loginuid)
                ->where('user_status', '=', 'Y')->first();

        } else {
            Cookie::queue(Cookie::forget('loginuid'));

        }

        $useruid = isset($user->uid) ? $user->uid : '';

        return $useruid;
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
        $Newsletters = Newsletters::where('news_type','subscribe')
        ->where('news_status','Y')
            ->where(function ($query) use ($search) {
                if ($search != '') {
                    $query->orwhere('news_subject', 'like', '%' . $search . '%');
                    $query->orwhere('news_message', 'like', '%' . $search . '%');
                }
        })->orderBy('created_at','desc')->paginate($this->paging);


       // $Newsletters = Newsletters::where('news_type','subscribe')->orderBy('created_at','desc')->paginate($this->paging);

        return view('admins.pages.subscribe.index', compact('Newsletters'));
    }

 
  
    public function delete(Request $request)
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
         
        $uid =  $request->uid;
        
        $Newsletters = Newsletters::where('news_uid', '=', $uid)->first();
        
        $success = false;
        $message = 'fail';
        $response = [];
        if ($Newsletters) {
            $success = true;
          
            $message = 'success';
            $success =  Newsletters::where('news_uid', '=', $uid)->update([
                "news_status" => 'N'
            ]);
            
        }
        
        return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }


}
