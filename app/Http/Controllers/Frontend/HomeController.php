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

class HomeController extends Controller
{

    protected $paging = 10;
    protected $useruid = '';

    public function home()
    {
        $slidepage = Slidepage::where('slidepages_status', '=', 'Y')
        ->orderBy('slidepages_index')->paginate($this->paging);
        
         return view('frontend.pages.home',compact('slidepage'));
    }

    public function index(Request $request)    {
        $slidepage = Slidepage::where('slidepages_status', '=', 'Y')
        ->orderBy('slidepages_index')->paginate($this->paging);
        $courseGroup =Course::where('course_status','=','Y')->orderBy('course_index')->get();
        $courseAll =CourseItem::where('course_item_status','=','Y')->orderBy('courseref_name')->orderBy('course_item_index')->get();
        $courses_slide =Pageheader::where('pageheader_type','=','courses_slide')->first();

        $courses=Pageheader::where('pageheader_type','=','course')->first();
        $news=Pageheader::where('pageheader_type','=','news')->first(); 
         return view('frontend.pages.home',compact('slidepage','courses_slide','courseGroup','courses','courseAll','news'));
    }

     
    public function aboutus()
    {
        
       
      
         return view('frontend.pages.aboutus');

         
    }
   
    public function contact()
    {
       
         return view('frontend.pages.contact');

         
    }

    

}
