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

class NewsController extends Controller
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
       dd('index');
    }


    public function home(Request $request)
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
   
        $news = Pageheader::where('pageheader_type', '=', 'news')->first();
          
        return view('admins.pages.news_home', compact('news'));
    }

    public function header(Request $request)
    {
       
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
   
          $fields = $request->validate(
            [

                'pageheader_title' => 'required|string',
                'pageheader_header' => 'required|string',
                'pageheader_detail' => 'required|string',
               
            ],
            [
                'pageheader_title.required' => 'Title Is Required ',
                'pageheader_header.required' => 'Header Is Required ',
                'pageheader_detail.required' => 'Detail Is Required ',
                

            ]
        );


        $pageheader_type='news';

        $pageheader =Pageheader::where('pageheader_type','=',$pageheader_type)->first();
       
        $success = false;
        $message = 'fail';
        $response = [];
        
        if($pageheader){

            $action =  Pageheader::where('pageheader_uid','=',$request->pageheader_uid)->update([
                'pageheader_title' =>$request->pageheader_title, 
                'pageheader_header'=>$request->pageheader_header, 
                 'pageheader_detail'=>$request->pageheader_detail

            ]);

        } else {

            $pageheader_uid = $this->NewUid();
            $action = Pageheader::insert([
                'pageheader_uid' => $pageheader_uid ,
                'pageheader_type' => $pageheader_type,
                'pageheader_title' =>$request->pageheader_title, 
                'pageheader_header'=>$request->pageheader_header, 
                 'pageheader_detail'=>$request->pageheader_detail,
                 'pageheader_status' => 'Y',

            ]);

        }
        
        $news =Pageheader::where('pageheader_type','=',$pageheader_type)->first();   
       
        return view('admins.pages.news_home', compact('news'));  
        
        //return response()->json(['success' => $success, 'message' => $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }



}
