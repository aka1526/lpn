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
use App\Models\Admins\Aboutus;
use App\Models\Admins\Sysinfo;
use App\Models\Admins\News;
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
        $neweven = News::where('news_status', '=', 'Y')
        ->orderBy('news_datetime')->take(6)->get();
         return view('frontend.pages.home',compact('slidepage','courses_slide','courseGroup','courses','courseAll','news','neweven'));
    }

    
    public function aboutus()
    {    
         return view('frontend.pages.aboutus');
        
    }
    public function contact()
    {   
          $sysinfo=Sysinfo::where('sys_status','=','Y')->first();
         return view('frontend.pages.contact',compact('sysinfo'));
        
    }

    public function aboutus_page(Request $request,$url)
    {
        
         $aboutus = Aboutus::where('aboutus_url','=',$url)->first();
      
         return view('frontend.pages.aboutus_page',compact('aboutus'));

         
    }

    
    public function news(Request $request)
    {    
     $news = News::where('news_status', '=', 'Y')
     ->orderBy('news_datetime')->paginate(9);
         return view('frontend.pages.news_index',compact('news'));
        
    }

//     public function aboutus_about() {
//      $url='about';    
//      $aboutus = Aboutus::where('aboutus_url','=',$url)->first();
//      return view('frontend/pages/aboutus_About',compact('aboutus'));
  
//     }
//     public function aboutus_history() {
//      $url='history';    
//      $aboutus = Aboutus::where('aboutus_url','=',$url)->first();
//      return view('frontend/pages/aboutus_Page-History');
  
//     }
//     public function aboutus_committees() {
//      $url='committees';    
//      $aboutus = Aboutus::where('aboutus_url','=',$url)->first();
//      return view('frontend/pages/aboutus_Committees');
  
//     }
//     public function aboutus_constitution() {
//      $url='constitution';    
//      $aboutus = Aboutus::where('aboutus_url','=',$url)->first();
//      return view('frontend/pages/aboutus_Constitution');
  
//     }
//     public function aboutus_contact() {
//      $url='contact';    
//      $aboutus = Aboutus::where('aboutus_url','=',$url)->first();
//      return view('frontend/pages/aboutus_Contact');
  
//     }
     

}
