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
use App\Models\Admins\Course;
use App\Models\Admins\CourseItem;


class CourseItemController extends Controller
{
    // 
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

    public function index(Request $request,$courseuid='')
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
   
        $courseItem = CourseItem::where('courseref_uid', '!=', $courseuid)->orderBy('course_item_index')->paginate($this->paging);;
     
        return view('admins.pages.course_item_add', compact('courseItem','courseuid'));
    }



    public function addnew(Request $request)
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
          
         // dd(htmlentities($request->course_details));
        // $course_details =htmlentities($request->course_details);
         $course_details = ($request->course_details);
        $fields = $request->validate(
            [

                'course_item_name' => 'required|string',
                'courseref_uid' => 'required|string'
            ],
            [
                'course_item_name.required'    => ' Course Name Is Required For Your Information ',
                'courseref_uid.required' => 'Ref Course  Is Required For Your Information Safety.',
                
            ]
        );

       $course_uid = $request->courseref_uid;

        $_course =Course::where('course_uid','=',$course_uid)->count();
        $course_item_index=0;
        if($_course > 0){

            $course =Course::where('course_uid','=',$course_uid)->first();
            $uid = $this->NewUid();
            $course_item_index=  CourseItem::where('courseref_uid','=',$course_uid)->max('course_item_index');
            $course_item_index=$course_item_index+1 ;
            $Action = CourseItem::insert([
                'course_item_uid' => $uid,
                'course_item_index' =>  $course_item_index,
                'course_item_name' => $request->course_item_name,
                'course_details'=>  $course_details ,
                'course_item_status' => $request->course_item_status,
                'courseref_uid' =>  $course_uid ,
                'courseref_name' =>  $course->course_name ,
                "course_item_price" => $request->course_item_price,
                "course_item_duration" => $request->course_item_duration,
                "course_item_certificate" => $request->course_item_certificate,
                'course_item_url' =>  $course->course_link .'/'. str_replace(' ', '-', $request->course_item_name),
                'created_at' => Carbon::now(),
                'update_at' => Carbon::now()
            ]);
            if( $Action){

                $this->Update_total($course_uid);

                
            }
        }

        

       
        $courseItem = CourseItem::where('courseref_uid', '=', $course_uid)->orderBy('course_item_index')->paginate($this->paging);;
        $success = false;
        $message = 'fail';
        $response = [];
        if ($Action) {
            $success = true;
            $message = 'success';
            $response = [
                'action' => $Action,
                'courseuid' => $course_uid
            ];
        }
        

          // return redirect()->back() ;
        return response()->json(['success' => $Action, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

    public function edit(Request $request,$uid='')
    {
         
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
   
        $courseItem = CourseItem::where('course_item_uid', '=', $uid)->first();
     
        return view('admins.pages.course_item_edit', compact('courseItem','uid'));
    }

    public function update(Request $request)
    {
 
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
          $uid=$request->course_item_uid;
          $courseItem = CourseItem::where('course_item_uid', '=', $uid)->first();
          $courseuid=  $courseItem->courseref_uid;
          $course =Course::where('course_uid','=',$courseuid)->first();

          $Action=false;
          if($courseItem){
           
            $Action=  CourseItem::where('course_item_uid', '=', $uid)->update([
                 "course_item_index" => $request->course_item_index,
                "course_item_name" => $request->course_item_name,
                "course_details" => $request->course_details,
                "course_item_status" => $request->course_item_status,
                "course_item_price" => $request->course_item_price,
                "course_item_duration" => $request->course_item_duration,
                "course_item_certificate" => $request->course_item_certificate,
                'course_item_url' =>  $course->course_link .'/'. str_replace(' ', '-', $request->course_item_name),
                "update_at" =>Carbon::now(),

            ]);

            if($Action){
                $this->Update_total($courseuid);
            }
          }
        
          $success = false;
          $message = 'fail';
          $response = [];
          if ($Action) {
              $success = true;
              $message = 'success';
              $response = [
                  'action' => $Action,
                  'courseuid' => $courseuid
              ];
          }
          
  
            // return redirect()->back() ;
          return response()->json(['success' => $Action, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

     
        
    }


    public function delete(Request $request)
    {
 
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
          $uid=$request->uid;
          $courseItem = CourseItem::where('course_item_uid', '=', $uid)->first();
          $courseuid=  $courseItem->courseref_uid;
          $Action=false;
          if($courseItem){
           
            $Action=  CourseItem::where('course_item_uid', '=', $uid)->delete();
            
            $this->Update_total($courseuid);
            
          }
        
          $success = false;
          $message = 'fail';
          $response = [];
          if ($Action) {
              $success = true;
              $message = 'success';
              $response = [
                  'action' => $Action,
                  'courseuid' => $courseuid
              ];
          }
          
  
            // return redirect()->back() ;
          return response()->json(['success' => $Action, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

     
        
    }

    public function Update_total($courseuid=''){

        if($courseuid!=''){
            $course_total=  CourseItem::where('courseref_uid','=',$courseuid)->count();
            $course =Course::where('course_uid','=',$courseuid)->update([
               'course_total' =>  $course_total
            ]); 
        }

    }
 
    public function updatestatus(Request $request)
    {
 
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
          $uid=$request->uid;
          $courseItem = CourseItem::where('course_item_uid', '=', $uid)->first();
          $courseuid=  $courseItem->courseref_uid;
          $Action=false;
          if($courseItem){
           
            $Action=  CourseItem::where('course_item_uid', '=', $uid)->update([
               
                "course_item_status" => $request->status,
                "update_at" =>Carbon::now(),

            ]);

            if($Action){
                $this->Update_total($courseuid);
            }
          }
        
          $success = false;
          $message = 'fail';
          $response = [];
          if ($Action) {
              $success = true;
              $message = 'success';
              $response = [
                  'action' => $Action,
                  'courseuid' => $courseuid
              ];
          }
          
  
            // return redirect()->back() ;
          return response()->json(['success' => $Action, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

     
        
    }


}
