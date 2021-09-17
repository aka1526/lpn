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
use App\Models\Admins\Pageheader;
use Image;
use File;

class CourseController extends Controller
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
   
        $course = Course::where('course_status', '!=', '')->orderBy('course_index')->paginate($this->paging);;
          
        return view('admins.pages.course_index', compact('course'));
    }


    public function home(Request $request)
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
   
        $courses = Pageheader::where('pageheader_type', '=', 'course')->first();
          
        return view('admins.pages.course_home', compact('courses'));
    }

    public function slide(Request $request)
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
   
        $courses_slide = Pageheader::where('pageheader_type', '=', 'courses_slide')->first();
          
        return view('admins.pages.course_slide', compact('courses_slide'));
    }
    


    

    public function add(Request $request)
    {
       
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }

         

        
       
        $success = false;
        $message = 'fail';
        $response = [];
        $course_total =0;
        $course_index = Course::max('course_index');
          
        if( $request->course_uid  !='' ) {

            $fields = $request->validate(
                [
                    'course_uid' => 'required|string',
                    'course_name' => 'required|string',
                ],
                [
                    'course_uid.required' => 'Password Is Required For Your Information Safety.',
                    'course_name.required' => 'Course Name Is Required ',
                    
                  
                ]
            );
           
            $uid =  $request->course_uid;
        
            $course = Course::where('course_uid', '=', $uid)->first();
           // $course_total= 0;
            $success = false;
            $message = 'fail';
            $response = [];
            if ($course) {

                $success = true;
              
                $message = 'success';
                $success =  Course::where('course_uid', '=', $uid)->update([
                   
                    'course_index' =>$request->course_index,
                    'course_name' =>$request->course_name,
                    'course_th' => "",
                    'course_description'=> $request->course_description,
                    'course_link' => str_replace(' ', '-', $request->course_name),
                    //'course_total' =>$course_total,
                    'course_status' =>$request->course_status,
                    'course_icon' =>$request->course_icon,
                    
                    'update_at' => Carbon::now(),
    
                ]);

                $course_img = $this->uploadFile($request, $uid ) ;
                if( $course_img !=''){
                    Course::where('course_uid', '=', $uid)->update([
                        'course_img' => $course_img
                        ]);
                }
               
               
            }
            

        } else {

            $fields = $request->validate(
                [
    
                    'course_name' => 'required|string|unique:courses,course_name',
                    
                   
                ],
                [
                    'course_name.required' => 'Course Name Is Required ',
                    'course_name.unique' => 'Course Name Is Duplicate ',
                      ]
            );

            $uid =   $this->NewUid();

            $course_img = $this->uploadFile($request, $uid ) ;
             
            $action = Course::insert([
                'course_uid'=> $uid,
                'course_index' =>  (int)$course_index+1,
                'course_name' =>$request->course_name,
                'course_th' => "",
                'course_img' => $course_img ,
                'course_description'=> $request->course_description,
                'course_link' =>  strtolower(str_replace(' ', '-', $request->course_name)),
                'course_total' =>$course_total,
                'course_status' =>$request->course_status,
                'course_icon' =>$request->course_icon,
                'created_at' => Carbon::now(),
                'update_at' => Carbon::now(),
              
    
            ]);
            
    
            if ($action) {
                $success = $action;
                $message = 'success';
                $response = [];
            }
             
        }
        return redirect()->back();
       
        //return response()->json(['success' => $success, 'message' => $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

    public function get(Request $request)
    {

        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
        $uid =  $request->uid;
        $course = Course::where('course_uid', '=', $uid)->first();
        $success = false;
        $message = 'fail';
        $response = [];
        if ($course) {
            $success = true;
            $message = 'success';
            $response = [
                'course_uid' => $course->course_uid,
                'course_index' => $course->course_index,
                'course_name' => $course->course_name,
                'course_description' => $course->course_description,
                'course_status' => $course->course_status,
                'course_icon' => $course->course_icon,
            ];
        }
        return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

    public function update(Request $request)
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
        $fields = $request->validate(
            [
                'course_uid' => 'required|string',
                'course_name' => 'required|string',
            ],
            [
                'course_uid.required' => 'Password Is Required For Your Information Safety.',
                'course_name.required' => 'Course Name Is Required ',
                
              
            ]
        );

        $uid =  $request->course_uid;
        
        $course = Course::where('course_uid', '=', $uid)->first();
       // $course_total= 0;
        $success = false;
        $message = 'fail';
        $response = [];
        if ($course) {
            $success = true;
          
            $message = 'success';
            $success =  Course::where('course_uid', '=', $uid)->update([
               
                'course_index' =>$request->course_index,
                'course_name' =>$request->course_name,
                'course_th' => "",
                'course_description'=> $request->course_description,
               // 'course_link' => strtolower(str_replace(' ', '-', $request->course_name)),
                //'course_total' =>$course_total,
                'course_status' =>$request->course_status,
                'course_icon' =>$request->course_icon,
                
                'update_at' => Carbon::now(),

            ]);
           
        }
        
        return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }


    public function items(Request $request,$courseuid='' ) {
       
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
        }
        $course_uid =$courseuid;
        $courseitem = CourseItem::where('courseref_uid', '=', $courseuid)->orderBy('course_item_index')->paginate($this->paging);;
          return view('admins.pages.course_item', compact('courseitem','course_uid'));
 
    }


    public function delete(Request $request)
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
         
        $uid =  $request->uid;
        
        $course = Course::where('course_uid', '=', $uid)->first();
        $course_total= 0;
        $success = false;
        $message = 'fail';
        $response = [];
        if ($course) {
            $success = true;
          
            $message = 'success';
            $success =  Course::where('course_uid', '=', $uid)->delete();
            if($success){
                CourseItem::where('courseref_uid', '=', $uid)->delete();
            }
           
        }
        
        return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

    public function updatestatus(Request $request)
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
         
        $uid =  $request->uid;
        
        $course = Course::where('course_uid', '=', $uid)->first();
        $course_total= 0;
        $success = false;
        $message = 'fail';
        $response = [];
        if ($course) {
            $success = true;
             $message = 'success';
              
            $success =  Course::where('course_uid', '=', $uid)->update([
                "course_status" =>  $request->status,
            ]);
            $response = [
                "success" =>  $success,
            ];
           
        }
        
        return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
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


        $pageheader_type='course';

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
        
        $courses =Pageheader::where('pageheader_type','=',$pageheader_type)->first();   
       
        return view('admins.pages.course_home', compact('courses'));  
        
        //return response()->json(['success' => $success, 'message' => $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

    

    public function courses_slide(Request $request)
    {
       
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
   
          $fields = $request->validate(
            [

                'pageheader_title' => 'required|string',
                'pageheader_header' => 'required|string',
                
               
            ],
            [
                'pageheader_title.required' => 'Title Is Required ',
                'pageheader_header.required' => 'Header Is Required ',
                 
                

            ]
        );


        $pageheader_type='courses_slide';

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
        
        $courses_slide =Pageheader::where('pageheader_type','=',$pageheader_type)->first();   
       
        return view('admins.pages.course_slide', compact('courses_slide'));  
        
        //return response()->json(['success' => $success, 'message' => $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

    public function uploadFile(Request $request,$uid='')
    {
        $image = $request->file('fileupload');
        $uid = $uid !='' ? $uid :   $request->course_uid;

        $course = Course::where('course_uid', '=', $uid)->first();
        $course_link = isset( $course->course_link) && $course->course_link !='' ? $course->course_link : strtolower(str_replace(' ', '-', $request->course_name));
        //dd(     $course_link );
        $imagename = '';
        if ($image) {
            $imagename = time() . '.' . $image->extension();

            $filePath = public_path('/images/course/'.$course_link);
            $filePath_thumbnails = public_path('/images/course/'.$course_link.'/thumbnails');
            if (!File::exists($filePath_thumbnails)) {

                File::makeDirectory($filePath_thumbnails, 0755, true, true);
            }

            $image_thumbnail = Image::make($image->getRealPath());
            $image_thumbnail->resize(445, 200); //
            $image_thumbnail->save($filePath_thumbnails . '/' . $imagename);
            
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(1932, 445); //
            $image_resize->save($filePath . '/' . $imagename);
            
        }

        return $imagename;
    }

}
