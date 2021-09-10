<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Cookie;
use File;
use DB;

use App\Models\Admins\Slidepage;
use App\Models\Admins\Pageheader;
use App\Models\Admins\Course;
use App\Models\Admins\CourseItem;

class CourseFnController extends Controller
{

    protected $paging = 8;
    protected $useruid = '';

    public function home()
    {
        $slidepage = Slidepage::where('slidepages_status', '=', 'Y')
        ->orderBy('slidepages_index')->paginate($this->paging);
        
         return view('frontend.pages.home',compact('slidepage'));
    }

    public function index(Request $request,$course_link)    {
          
          $course =Course::where('course_link','=',$course_link)->first();
       
          if(!$course){return view('/frontend/pages/404');}
     
          $courses_item=CourseItem::where('courseref_uid','=',$course->course_uid)->orderBy('course_item_index')->paginate($this->paging);
         return view('frontend.pages.course_main',compact('course','courses_item'));
    }

    public function detail(Request $request,$course_link,$item)    {
         
     $course_item_url=$course_link.'/'.$item ;
     $course =Course::where('course_link','=',$course_link)->first();
     if(!$course){return view('/frontend/pages/404');}
     $courses_item=CourseItem::where('course_item_url','=',$course_item_url)->first();
     if(!$courses_item){return view('/frontend/pages/404');}

     return view('frontend.pages.course_detail',compact('course','courses_item'));
}


     
    

}
