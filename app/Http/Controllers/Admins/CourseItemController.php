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
use Image;
use File;

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
                'course_item_name' => 'required|string|unique:courses_item,course_item_name',
              //  'course_item_name' => 'required|string',
                'courseref_uid' => 'required|string'
            ],
            [
                'course_item_name.required'    => ' Course Name Is Required For Your Information ',
                'course_item_name.unique' => 'Course Name Is Duplicate ',
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
            $url= strtolower($course->course_link ).'/'. strtolower(str_replace(' ', '-', $request->course_item_name));
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
                'course_item_url' => $url,
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
        $courseuid = $courseItem ->courseref_uid;
     
        return view('admins.pages.course_item_edit', compact('courseItem','uid','courseuid'));
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
          $url=strtolower($course->course_link ).'/'.strtolower(str_replace(' ', '-', $request->course_item_name));
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
               // 'course_item_url' =>    $url ,
                "update_at" =>Carbon::now(),

            ]);

            if($Action){
              $this->Update_total($courseuid);
              $this->uploadFile($request);
            }
          }

    //       "img_home" => Symfony\Component\HttpFoundation\File\UploadedFile {#33 ???}
    //   "img_herder" => Symfony\Component\HttpFoundation\File\UploadedFile {#34 ???}
    //   "img_detail" => Symfony\Component\HttpFoundation\File\UploadedFile {#35 ???}

          $img_home=$request->img_home;
          $img_home= $this->uploadFile($request,$img_home,1);

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
          
          
          return redirect('/pageadmin/course/items/edit/'.$uid);
        //  return response()->json(['success' => $Action, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

     
        
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

     public function uploadFile(Request $request)
    {

      
        $course_item_uid= $request->course_item_uid;
        //$url=strtolower(str_replace(' ', '-', $request->course_item_name));
       // $course_item_uid =$request->course_item_name;
        $item = CourseItem::where('course_item_uid', '=', $course_item_uid)->first();
        $url= isset($item->course_item_url) && $item->course_item_url !='' ? $item->course_item_url : strtolower(str_replace(' ', '-', $request->course_item_name));

       if( $request->file('img_home') ){
         $image1 = $request->file('img_home');
         $image1name = '';
         
         if ($image1) {
              
             $image1name = 'home_'. $this->NewUid(). '.' . $image1->extension();
            

            $filePath = public_path('/images/course/'. $url);
             $filePath_thumbnails = public_path('/images/course/'. $url.'/thumbnails');
             if (!File::exists($filePath_thumbnails)) {
 
                 File::makeDirectory($filePath_thumbnails, 0755, true, true);
             }
 
           
                 $image1_resize = Image::make($image1->getRealPath());
                 $image1_resize->resize(260,174); //
                 $image1_resize->save($filePath_thumbnails . '/' . $image1name);
             
                 $image1_resize2 = Image::make($image1->getRealPath());
                 $image1_resize2->resize(260,174); //
                 $image1_resize2->save($filePath . '/' . $image1name);
 
                 if($image1name!=''){
                     CourseItem::where('course_item_uid', '=', $course_item_uid)->update([
                         "course_item_home_img" =>   $image1name
                     ]);
                   }

         }
       }
 

       if( $request->file('img_herder') ){
        $image2 = $request->file('img_herder');
        $image2name = '';
        if ($image2) {
             
            $image2name = 'herder_'. $this->NewUid(). '.' . $image2->extension();
            
           $filePath = public_path('/images/course/'.$url);
            $filePath_thumbnails = public_path('/images/course/'.$url.'/thumbnails');
            if (!File::exists($filePath_thumbnails)) {

                File::makeDirectory($filePath_thumbnails, 0755, true, true);
            }

          
                $image2_resize = Image::make($image2->getRealPath());
                $image2_resize->resize(1932,445); //
                $image2_resize->save($filePath_thumbnails . '/' . $image2name);
            
                $image2_resize2 = Image::make($image2->getRealPath());
                $image2_resize2->resize(1932,445); //
                $image2_resize2->save($filePath . '/' . $image2name);

                if($image2name!=''){
                    CourseItem::where('course_item_uid', '=', $course_item_uid)->update([
                        "course_item_header_img" =>   $image2name
                    ]);
                  }

        }
      }
 
      if( $request->file('img_detail') ){
        $image3 = $request->file('img_detail');
        $image3name = '';
        if ($image3) {
             
            $image3name = 'detail_'. $this->NewUid() . '.' . $image3->extension();
            
           $filePath = public_path('/images/course/'.$url);
            $filePath_thumbnails = public_path('/images/course/'.$url.'/thumbnails');
            if (!File::exists($filePath_thumbnails)) {

                File::makeDirectory($filePath_thumbnails, 0755, true, true);
            }

          
                $image3_resize = Image::make($image3->getRealPath());
                $image3_resize->resize(868,293); //
                $image3_resize->save($filePath_thumbnails . '/' . $image3name);

                $image3_resize2 = Image::make($image3->getRealPath());
                $image3_resize2->resize(868,293); //
                $image3_resize2->save($filePath . '/' . $image3name);

                if($image3name!=''){
                    CourseItem::where('course_item_uid', '=', $course_item_uid)->update([
                        "course_item_detail_img" =>   $image3name
                    ]);
                  }

        }
      }
 

        return true;
    }



}
