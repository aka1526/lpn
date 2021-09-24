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
use App\Models\Admins\Sysinfo;


class SysinfoController extends Controller
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
   
        $sysinfo = Sysinfo::where('sys_status', '=', 'Y')->first();

        return view('admins.pages.sysinfo_index', compact('sysinfo'));
        
    }

 
    public function add(Request $request)
    {
       
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
   
          $fields = $request->validate(
            [

                'sys_name' => 'required|string',
                'sys_address' => 'required|string',
        
               
            ],
            [
                'sys_name.required' => 'Company Name Is Required ',
                'sys_address.required' => 'Address Is Required ',
              

            ]
        );


        $pageheader_type='news';

        $sysinfo =Sysinfo::where('sys_status','=','Y')->first();
       
        $success = false;
        $message = 'fail';
        $response = [];
        
        if($sysinfo){

            $action =  Sysinfo::where('sys_uid','=',$sysinfo->sys_uid)->update([
                'sys_name'=>$request->sys_name, 
                'sys_name_th' => $request->sys_name_th, 
                'sys_address'=>$request->sys_address, 
                'sys_country' => $request->sys_country, 
                'sys_slogan' => $request->sys_slogan,
                'sys_email1'=>$request->sys_email1, 
                'sys_email2'=>$request->sys_email2, 
                'sys_phone1'=>$request->sys_phone1, 
                'sys_phone2'=>$request->sys_phone2, 
                'sys_openday'=>$request->sys_openday, 
                'sys_openhour'=>$request->sys_openhour, 
                'sys_facebook'=>$request->sys_facebook, 
                'sys_twitter'=>$request->sys_twitter, 
                'sys_youtube'=>$request->sys_youtube, 
                'sys_intragram'=>$request->sys_intragram, 
        
                'sys_googlemap_lat'=>$request->sys_googlemap_lat, 
                'sys_googlemap_lon'=>$request->sys_googlemap_lon, 
                'sys_googlemap_zoom'=>$request->sys_googlemap_zoom, 
                'sys_googlemap_info'=>$request->sys_googlemap_info, 
                'sys_googlemap_marker'=>$request->sys_googlemap_marker, 
                'sys_www'=>$request->sys_www, 
                
                'sys_status'=> "Y", 
              
                'updated_at'=> Carbon::now(), 

            ]);

        } else {

            $sys_uid = $this->NewUid();
            $action = Sysinfo::insert([
                'sys_uid' =>$sys_uid, 
                'sys_name'=>$request->sys_name, 
                'sys_name_th' => $request->sys_name_th, 
                'sys_address'=>$request->sys_address, 
                'sys_country' => $request->sys_country, 
                'sys_slogan' => $request->sys_slogan,
                'sys_email1'=>$request->sys_email1, 
                'sys_email2'=>$request->sys_email2, 
                'sys_phone1'=>$request->sys_phone1, 
                'sys_phone2'=>$request->sys_phone2, 
                'sys_openday'=>$request->sys_openday, 
                'sys_openhour'=>$request->sys_openhour, 
                'sys_facebook'=>$request->sys_facebook, 
                'sys_twitter'=>$request->sys_twitter, 
                'sys_youtube'=>$request->sys_youtube, 
                'sys_intragram'=>$request->sys_intragram, 
        
                'sys_googlemap_lat'=>$request->sys_googlemap_lat, 
                'sys_googlemap_lon'=>$request->sys_googlemap_lon, 
                'sys_googlemap_zoom'=>$request->sys_googlemap_zoom, 
                'sys_googlemap_info'=>$request->sys_googlemap_info, 
                'sys_googlemap_marker'=>$request->sys_googlemap_marker, 
                'sys_www'=>$request->sys_www, 
                'sys_status'=> "Y", 
                'created_at'=> Carbon::now(), 
                'updated_at'=> Carbon::now(), 

            ]);

        }
        
        $sysinfo = Sysinfo::where('sys_status', '=', 'Y')->first();
       
        return view('admins.pages.sysinfo_index', compact('sysinfo'));  
        
        //return response()->json(['success' => $success, 'message' => $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }



}
