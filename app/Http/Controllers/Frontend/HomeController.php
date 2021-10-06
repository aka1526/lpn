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
use App\Models\Admins\Members;
use App\Models\Admins\Rankings;
use App\Models\Admins\Rankingslist;
use App\Models\Admins\Halloffames;

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

    public function members(Request $request)
    {    
       //  dd($request);
     $search=isset( $request->search ) ?  $request->search : ''; 
     $members = Members::where('isdelete', '=', 'N')
     ->whereIn('user_type', ['STUDENTS', 'TEACHERS'])
     ->where(function($query) use ($search) {
          if ($search !='') {
              return $query->where('member_no','like', '%'.$search.'%')
              ->orWhere('first_name','like', '%'.$search.'%')
              ->orWhere('last_name','like', '%'.$search.'%')
              ->orWhere('full_name','like', '%'.$search.'%')
                  ;

          }
      })
     ->orderBy('max_no')->paginate(9);
         return view('frontend.pages.members.index',compact('members'));
        
    }

    public function members_teachers(Request $request)
    {    
       //  dd($request);
     $search=isset( $request->search ) ?  $request->search : ''; 
     $members = Members::where('isdelete', '=', 'N')
     ->whereIn('user_type', [ 'TEACHERS'])
     ->where(function($query) use ($search) {
          if ($search !='') {
              return $query->where('member_no','like', '%'.$search.'%')
              ->orWhere('first_name','like', '%'.$search.'%')
              ->orWhere('last_name','like', '%'.$search.'%')
              ->orWhere('full_name','like', '%'.$search.'%')
                  ;

          }
      })
     ->orderBy('max_no')->paginate(9);
         return view('frontend.pages.members.index',compact('members'));
        
    }
    public function members_students(Request $request)
    {    
       //  dd($request);
     $search=isset( $request->search ) ?  $request->search : ''; 
     $members = Members::where('isdelete', '=', 'N')
     ->whereIn('user_type', ['STUDENTS'])
     ->where(function($query) use ($search) {
          if ($search !='') {
              return $query->where('member_no','like', '%'.$search.'%')
              ->orWhere('first_name','like', '%'.$search.'%')
              ->orWhere('last_name','like', '%'.$search.'%')
              ->orWhere('full_name','like', '%'.$search.'%')
                  ;

          }
      })
     ->orderBy('max_no')->paginate(9);
         return view('frontend.pages.members.index',compact('members'));
        
    }
 
    public function rankings_index(Request $request)
    {    
      
     $search='MALE'; 
     $rankings = Rankings::where('rank_gander', '=', $search)
     ->orderBy('rank_index')->get();
         return view('frontend.pages.rankings.index',compact('rankings'));
        
    }

    public function rankings_m(Request $request)
    {    
      
     $search='MALE'; 
     $rankings = Rankings::where('rank_gander', '=', $search)
     ->orderBy('rank_index')->get();
         return view('frontend.pages.rankings.index',compact('rankings'));
        
    }

    public function rankings_f(Request $request)
    {    
      
     $search='FEMALE'; 
     $rankings = Rankings::where('rank_gander', '=', $search)
     ->orderBy('rank_index')->get();
         return view('frontend.pages.rankings.index',compact('rankings'));
        
    }


    public function world_m(Request $request)
    {    
      
     $search='MALE'; 
     $rankingslist = Rankingslist::select('rankingslist.*','rankings_weight','rankings_weight_desc')
     ->where('contenders_gander', '=', $search)
     ->leftJoin("rankings", "rankings.rank_uid", "=", "rankingslist.list_ref")
     ->where('contenders_type','WORLD')
     ->orderBy('list_index')->get();
         return view('frontend.pages.rankings.world',compact('rankingslist'));
        
    }
    public function world_f(Request $request)
    {    
      
     $search='FEMALE'; 
     $rankingslist = Rankingslist::select('rankingslist.*','rankings_weight','rankings_weight_desc')
     ->where('contenders_gander', '=', $search)
     ->leftJoin("rankings", "rankings.rank_uid", "=", "rankingslist.list_ref")
     ->where('contenders_type','WORLD')
     ->orderBy('list_index')->get();
         return view('frontend.pages.rankings.world',compact('rankingslist'));
        
    }
 
    public function inter_m(Request $request)
    {    
      
     $search='MALE'; 
     $rankingslist = Rankingslist::select('rankingslist.*','rankings_weight','rankings_weight_desc')
     ->where('contenders_gander', '=', $search)
     ->leftJoin("rankings", "rankings.rank_uid", "=", "rankingslist.list_ref")
     ->where('contenders_type','INTERNATIONAL')
     ->orderBy('list_index')->get();
         return view('frontend.pages.rankings.inter',compact('rankingslist'));
        
    }

    public function inter_f(Request $request)
    {    
      
     $search='FEMALE'; 
     $rankingslist = Rankingslist::select('rankingslist.*','rankings_weight','rankings_weight_desc')
     ->where('contenders_gander', '=', $search)
     ->leftJoin("rankings", "rankings.rank_uid", "=", "rankingslist.list_ref")
     ->where('contenders_type','INTERNATIONAL')
     ->orderBy('list_index')->get();
         return view('frontend.pages.rankings.inter',compact('rankingslist'));
        
    }


    public function hall_of_fame(Request $request)
    {    
   
    // $search='FEMALE'; 
     $halloffames = Halloffames::where('content_status','Y')
     ->orderBy('hof_index','desc')->get();
         return view('frontend.pages.halloffames.index',compact('halloffames'));
        
    }

    public function hall_of_fameView(Request $request,$hof_slug='')
    {    
   //dd($hof_slug);
    // $search='FEMALE'; 
     $halloffame = Halloffames::where('content_status','Y')->where('hof_slug',$hof_slug)
     ->orderBy('hof_index','desc')->first();
         return view('frontend.pages.halloffames.view',compact('halloffame'));
        
    }

}
 