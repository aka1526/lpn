<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admins\Aboutus;
use App\Models\Admins\Course;
use App\Models\Admins\CourseItem;
use App\Models\Admins\Halloffames;
use App\Models\Admins\Members;
use App\Models\Admins\News;
use App\Models\Admins\Pageheader;
use App\Models\Admins\Rankings;
use App\Models\Admins\Rankingslist;
use App\Models\Admins\Slidepage;
use App\Models\Admins\Sysinfo;
use Illuminate\Http\Request;
use App\Models\Admins\Organizations;


class HomeController extends Controller
{

    protected $paging = 10;
    protected $useruid = '';

    public function home()
    {
        $slidepage = Slidepage::where('slidepages_status', '=', 'Y')
            ->orderBy('slidepages_index')->paginate($this->paging);

        return view('frontend.pages.home', compact('slidepage'));
    }

    public function index(Request $request)
    {
        $slidepage = Slidepage::where('slidepages_status', '=', 'Y')
            ->orderBy('slidepages_index')->paginate($this->paging);
        $courseGroup = Course::where('course_status', '=', 'Y')->orderBy('course_index')->get();
        $courseAll = CourseItem::where('course_item_status', '=', 'Y')->orderBy('courseref_name')->orderBy('course_item_index')->get();
        $courses_slide = Pageheader::where('pageheader_type', '=', 'courses_slide')->first();

        $courses = Pageheader::where('pageheader_type', '=', 'course')->first();
        $news = Pageheader::where('pageheader_type', '=', 'news')->first();
        $neweven = News::where('news_status', '=', 'Y')
            ->orderBy('news_datetime')->take(6)->get();
        return view('frontend.pages.home', compact('slidepage', 'courses_slide', 'courseGroup', 'courses', 'courseAll', 'news', 'neweven'));
    }

    public function aboutus()
    {
        return view('frontend.pages.aboutus');

    }
    public function contact()
    {
        $sysinfo = Sysinfo::where('sys_status', '=', 'Y')->first();
        return view('frontend.pages.contact', compact('sysinfo'));

    }

    public function aboutus_page(Request $request, $url)
    {

        $aboutus = Aboutus::where('aboutus_url', '=', $url)->first();

        return view('frontend.pages.aboutus_page', compact('aboutus'));

    }

    public function news(Request $request)
    {
        $news = News::where('news_status', '=', 'Y')
            ->orderBy('news_datetime')->paginate(9);
        return view('frontend.pages.news.index', compact('news'));

    }

    public function news_detail(Request $request,$detail=null){
       //dd($detail);
        $news = News::where('news_status', '=', 'Y')
            ->where('news_url',$detail)->first();
       $randomnews = News::where('news_status', '=', 'Y')
            ->where('news_url','!=',$detail)->inRandomOrder(3)->get();
             
        return view('frontend.pages.news.detail', compact('news','randomnews'));

    }
    


    public function members(Request $request)
    {
        //  dd($request);
        $search = isset($request->search) ? $request->search : '';
        $members = Members::where('isdelete', '=', 'N')
            ->whereIn('user_type', ['STUDENTS', 'TEACHERS'])
            ->where(function ($query) use ($search) {
                if ($search != '') {
                    return $query->where('member_no', 'like', '%' . $search . '%')
                        ->orWhere('first_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%')
                        ->orWhere('full_name', 'like', '%' . $search . '%')
                    ;

                }
            })
            ->orderBy('max_no')->paginate(9);
        return view('frontend.pages.members.index', compact('members'));

    }

    public function members_teachers(Request $request)
    {
        //  dd($request);
        $search = isset($request->search) ? $request->search : '';
        $members = Members::where('isdelete', '=', 'N')
            ->whereIn('user_type', ['TEACHERS'])
            ->where(function ($query) use ($search) {
                if ($search != '') {
                    return $query->where('member_no', 'like', '%' . $search . '%')
                        ->orWhere('first_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%')
                        ->orWhere('full_name', 'like', '%' . $search . '%')
                    ;

                }
            })
            ->orderBy('max_no')->paginate(9);
        return view('frontend.pages.members.index', compact('members'));

    }
    public function members_students(Request $request)
    {
        //  dd($request);
        $search = isset($request->search) ? $request->search : '';
        $members = Members::where('isdelete', '=', 'N')
            ->whereIn('user_type', ['STUDENTS'])
            ->where(function ($query) use ($search) {
                if ($search != '') {
                    return $query->where('member_no', 'like', '%' . $search . '%')
                        ->orWhere('first_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%')
                        ->orWhere('full_name', 'like', '%' . $search . '%')
                    ;

                }
            })
            ->orderBy('max_no')->paginate(9);
        return view('frontend.pages.members.index', compact('members'));

    }

    public function rankings_index(Request $request)
    {

        $search = 'MALE';
        $rankings = Rankings::where('rank_gander', '=', $search)
            ->orderBy('rank_index')->get();
        return view('frontend.pages.rankings.index', compact('rankings'));

    }

    public function rankings_m(Request $request)
    {

        $search = 'MALE';
        $rankings = Rankings::where('rank_gander', '=', $search)
            ->orderBy('rank_index')->get();
        return view('frontend.pages.rankings.index', compact('rankings'));

    }

    public function rankings_f(Request $request)
    {

        $search = 'FEMALE';
        $rankings = Rankings::where('rank_gander', '=', $search)
            ->orderBy('rank_index')->get();
        return view('frontend.pages.rankings.index', compact('rankings'));

    }

    public function world_m(Request $request)
    {

        $search = 'MALE';
        $rankingslist = Rankingslist::select('rankingslist.*', 'rankings_weight', 'rankings_weight_desc')
            ->where('contenders_gander', '=', $search)
            ->leftJoin("rankings", "rankings.rank_uid", "=", "rankingslist.list_ref")
            ->where('contenders_type', 'WORLD')
            ->orderBy('list_index')->get();
        return view('frontend.pages.rankings.world', compact('rankingslist'));

    }
    public function world_f(Request $request)
    {

        $search = 'FEMALE';
        $rankingslist = Rankingslist::select('rankingslist.*', 'rankings_weight', 'rankings_weight_desc')
            ->where('contenders_gander', '=', $search)
            ->leftJoin("rankings", "rankings.rank_uid", "=", "rankingslist.list_ref")
            ->where('contenders_type', 'WORLD')
            ->orderBy('list_index')->get();
        return view('frontend.pages.rankings.world', compact('rankingslist'));

    }

    public function inter_m(Request $request)
    {

        $search = 'MALE';
        $rankingslist = Rankingslist::select('rankingslist.*', 'rankings_weight', 'rankings_weight_desc')
            ->where('contenders_gander', '=', $search)
            ->leftJoin("rankings", "rankings.rank_uid", "=", "rankingslist.list_ref")
            ->where('contenders_type', 'INTERNATIONAL')
            ->orderBy('list_index')->get();
        return view('frontend.pages.rankings.inter', compact('rankingslist'));

    }

    public function inter_f(Request $request)
    {

        $search = 'FEMALE';
        $rankingslist = Rankingslist::select('rankingslist.*', 'rankings_weight', 'rankings_weight_desc')
            ->where('contenders_gander', '=', $search)
            ->leftJoin("rankings", "rankings.rank_uid", "=", "rankingslist.list_ref")
            ->where('contenders_type', 'INTERNATIONAL')
            ->orderBy('list_index')->get();
        return view('frontend.pages.rankings.inter', compact('rankingslist'));

    }

    public function hall_of_fame(Request $request)
    {

        // $search='FEMALE';
        $halloffames = Halloffames::where('content_status', 'Y')
            ->orderBy('hof_index', 'desc')->get();
        return view('frontend.pages.halloffames.index', compact('halloffames'));

    }

    public function hall_of_fameView(Request $request, $hof_slug = '')
    {
        //dd($hof_slug);
        // $search='FEMALE';
        $halloffame = Halloffames::where('content_status', 'Y')->where('hof_slug', $hof_slug)
            ->orderBy('hof_index', 'desc')->first();
        return view('frontend.pages.halloffames.view', compact('halloffame'));

    }

    public function continent(Request $request)
    {

        // th: '#2980b9',
        // ru: '#27ae60',
        // kz: '#8ED110',
        // cn: '#8e44ad'

        $member_continent = array();
        // $member_asia["th"] = $this->ColorSet1(0);
        // $member_asia["ru"] = $this->ColorSet1(1);
        // $member_asia["cn"] = $this->ColorSet1(2);
        
       $member=  Members::select('country_code')->where('member_status','Y')
       ->groupBy('country_code')->orderBy('country_code')->get();
        $coler=0;
       foreach($member as $item){
        $member_continent[$item->country_code] = $this->ColorSet1($coler);
        $coler++;
       }
        // dd($asia_color);
        // $search='FEMALE';
        $continent = array("africa", "asia", "australia", "europe", "north-america", "south-america");
        //->orderBy('hof_index','desc')->get();
        return view('frontend.pages.continent.index', compact('continent', 'member_continent'));

    }

    public function getMemberContinent(Request $request)
    {
      
        $country_code=$request->country_code !='' ? $request->country_code :'';
 
       $_member=  Members::where('member_status','Y')->where('country_code',$country_code)
       ->orderBy('full_name')->get();
        $coler=0;
       foreach($member as $item){
        $member_continent[$item->country_code] = $this->ColorSet1($coler);
        $coler++;
       }
 
        return  $html;

    }


    public function countries(Request $request)
    {

        // $search='FEMALE';
        $Organizations = Organizations::select('org_country_code','org_country_name')
        ->where('org_status', 'Y')
        ->groupBy('org_country_code')->groupBy('org_country_name')->orderBy('org_country_name')->get();
        return view('frontend.pages.countries.index', compact('Organizations'));

    }

    public function area_member(Request $request)
    {

        // $search='FEMALE';
        $halloffames = Halloffames::where('content_status', 'Y')
            ->orderBy('hof_index', 'desc')->get();
        return view('frontend.pages.halloffames.index', compact('halloffames'));

    }
    public function club_member(Request $request)
    {

        $search = $request->search;
      //  $organizations = Organizations::where('org_status', 'Y')
       //     ->orderBy('org_name')->paginate($this->paging);
         
            $organizations = Organizations::where('org_status', 'Y')
            ->where(function ($query) use ($search) {
                if ($search != '') {
                    $query->orwhere('org_name', 'like', '%' . $search . '%');
                    $query->orwhere('org_country_name', 'like', '%' . $search . '%');
                } 
            })
            ->orderBy('org_name')->paginate($this->paging);        
        return view('frontend.pages.club-member.index', compact('organizations'));

    }

    public function ColorSet1($i = 0)
    {
        $color = array(
            "#0048BA"
            , "#B0BF1A"
            , "#7CB9E8"
            , "#C0E8D5"
            , "#B284BE"
            , "#72A0C1"
            , "#EDEAE0"
            , "#F0F8FF"
            , "#C46210"
            , "#EFDECD"
            , "#E52B50"
            , "#9F2B68"
            , "#F19CBB"
            , "#AB274F"
            , "#D3212D"
            , "#3B7A57"
            , "#FFBF00"
            , "#FF7E00"
            , "#9966CC"
            , "#3DDC84"
            , "#CD9575"
            , "#665D1E"
            , "#915C83"
            , "#841B2D"
            , "#FAEBD7"
            , "#008000"
            , "#8DB600"
            , "#FBCEB1"
            , "#00FFFF"
            , "#7FFFD4"
            , "#D0FF14"
            , "#4B5320"
            , "#8F9779"
            , "#E9D66B"
            , "#B2BEB5"
            , "#87A96B"
            , "#FF9966"
            , "#A52A2A"
            , "#FDEE00"
            , "#568203"
            , "#007FFF"
            , "#F0FFFF"
            , "#89CFF0"
            , "#A1CAF1"
            , "#F4C2C2"
            , "#FEFEFA"
            , "#FF91AF"
            , "#FAE7B5"
            , "#DA1884"
            , "#7C0A02"
            , "#848482"
            , "#BCD4E6"
            , "#9F8170"
            , "#F5F5DC"
            , "#2E5894"
            , "#9C2542"
            , "#FFE4C4"
            , "#3D2B1F"
            , "#967117"
            , "#CAE00D"
            , "#BFFF00"
            , "#FE6F5E"
            , "#BF4F51"
            , "#000000"
            , "#3D0C02"
            , "#1B1811"
            , "#3B2F2F"
            , "#54626F"
            , "#3B3C36"
            , "#BFAFB2"
            , "#FFEBCD"
            , "#A57164"
            , "#318CE7"
            , "#ACE5EE"
            , "#FAF0BE"
            , "#660000"
            , "#0000FF",
        );

        return $color[$i];
    }

    public function ColorSet2($i = 0)
    {
        $color = array(
            "#1F75FE"
            , "#0093AF"
            , "#0087BD"
            , "#0018A8"
            , "#333399"
            , "#0247FE"
            , "#A2A2D0"
            , "#6699CC"
            , "#0D98BA"
            , "#064E40"
            , "#5DADEC"
            , "#126180"
            , "#8A2BE2"
            , "#7366BD"
            , "#4D1A7F"
            , "#5072A7"
            , "#3C69E7"
            , "#DE5D83"
            , "#79443B"
            , "#E3DAC9"
            , "#006A4E"
            , "#87413F"
            , "#CB4154"
            , "#66FF00"
            , "#D891EF"
            , "#C32148"
            , "#1974D2"
            , "#FFAA1D"
            , "#FF55A3"
            , "#FB607F"
            , "#004225"
            , "#CD7F32"
            , "#88540B"
            , "#AF6E4D"
            , "#1B4D3E"
            , "#7BB661"
            , "#FFC680"
            , "#800020"
            , "#DEB887"
            , "#A17A74"
            , "#CC5500"
            , "#E97451"
            , "#8A3324"
            , "#BD33A4"
            , "#702963"
            , "#536872"
            , "#5F9EA0"
            , "#A9B2C3"
            , "#91A3B0"
            , "#006B3C"
            , "#ED872D"
            , "#E30022"
            , "#FFF600"
            , "#BDB76B"
            , "#483C32"
            , "#534B4F"
            , "#543D37"
            , "#8B008B"
            , "#4A5D23"
            , "#556B2F"
            , "#FF8C00"
            , "#9932CC"
            , "#03C03C"
            , "#301934"
            , "#8B0000"
            , "#E9967A"
            , "#8FBC8F"
            , "#318CE7"
            , "#ACE5EE"
            , "#FAF0BE"
            , "#660000"
            , "#0000FF"
            , "#1F75FE"
            , "#0093AF"
            , "#ACE5EE"
            , "#FAF0BE"
            , "#660000",

        );

        return $color[$i];
    }

    public function ColorSet3($i = 0)
    {
        $color = array(

            "#A67B5B"
            , "#4B3621"
            , "#A3C1AD"
            , "#C19A6B"
            , "#EFBBCC"
            , "#FFFF99"
            , "#FFEF00"
            , "#FF0800"
            , "#E4717A"
            , "#00BFFF"
            , "#592720"
            , "#C41E3A"
            , "#00CC99"
            , "#960018"
            , "#D70040"
            , "#FFA6C9"
            , "#B31B1B"
            , "#56A0D3"
            , "#ED9121"
            , "#00563F"
            , "#703642"
            , "#C95A49"
            , "#ACE1AF"
            , "#007BA7"
            , "#2F847C"
            , "#B2FFFF"
            , "#246BCE"
            , "#DE3163"
            , "#007BA7"
            , "#2A52BE"
            , "#6D9BC3"
            , "#1DACD6"
            , "#007AA5"
            , "#E03C31"
            , "#F7E7CE"
            , "#F1DDCF"
            , "#36454F"
            , "#232B2B"
            , "#E68FAC"
            , "#DFFF00"
            , "#7FFF00"
            , "#FFB7C5"
            , "#954535"
            , "#E23D28"
            , "#DE6FA1"
            , "#A8516E"
            , "#AA381E"
            , "#856088"
            , "#FFB200"
            , "#7B3F00"
            , "#D2691E"
            , "#58111A"
            , "#FFA700"
            , "#98817B"
            , "#E34234"
            , "#CD607E"
            , "#E4D00A"
            , "#9FA91F"
            , "#7F1734"
            , "#0047AB"
            , "#D2691E"
            , "#6F4E37"
            , "#B9D9EB"
            , "#F88379"
            , "#8C92AC"
            , "#B87333"
            , "#DA8A67"
            , "#AD6F69"
            , "#CB6D51"
            , "#996666"
            , "#FF3800"
            , "#FF7F50"
            , "#F88379"
            , "#893F45"
            , "#FBEC5D"
            , "#B31B1B"
            , "#6495ED",

        );

        return $color[$i];
    }
    public function ColorSet4($i = 0)
    {
        $color = array(
            "#3C1414"
            ,"#8CBED6"
            ,"#483D8B"
            ,"#2F4F4F"
            ,"#177245"
            ,"#00CED1"
            ,"#9400D3"
            ,"#00703C"
            ,"#555555"
            ,"#DA3287"
            ,"#FAD6A5"
            ,"#B94E48"
            ,"#004B49"
            ,"#FF1493"
            ,"#FF9933"
            ,"#00BFFF"
            ,"#4A646C"
            ,"#7E5E60"
            ,"#1560BD"
            ,"#2243B6"
            ,"#C19A6B"
            ,"#EDC9AF"
            ,"#696969"
            ,"#1E90FF"
            ,"#D71868"
            ,"#967117"
            ,"#00009C"
            ,"#EFDFBB"
            ,"#E1A95F"
            ,"#555D50"
            ,"#C2B280"
            ,"#1B1B1B"
            ,"#614051"
            ,"#F0EAD6"
            ,"#1034A6"
            ,"#16161D"
            ,"#7DF9FF"
            ,"#00FF00"
            ,"#6F00FF"
            ,"#CCFF00"
            ,"#BF00FF"
            ,"#8F00FF"
            ,"#50C878"
            ,"#6C3082"
            ,"#1B4D3E"
            ,"#B48395"
            ,"#AB4B52"
            ,"#CC474B"
            ,"#563C5C"
            ,"#00FF40"
            ,"#96C8A2"
            ,"#C19A6B"
            ,"#801818"
            ,"#B53389"
            ,"#DE5285"
            ,"#F400A1"
            ,"#E5AA70"
            ,"#4D5D53"
            ,"#4F7942"
            ,"#6C541E"
            ,"#FF5470"
            ,"#B22222"
            ,"#CE2029"
            ,"#E95C4B"
            ,"#E25822"
            ,"#EEDC82"
            ,"#A2006D"
            ,"#FFFAF0"
            ,"#15F4EE"
            ,"#5FA777"
            ,"#014421"
            ,"#228B22"
            ,"#A67B5B"
            ,"#856D4D"
            ,"#0072BB"
            ,"#FD3F92"
            ,"#86608E"
            
        );

        return $color[$i];
    }

    public function ColorSet5($i = 0)
    {
        $color = array(
           "#FAF0BE
            ,"#660000"
            ,"#0000FF"
            ,"#1F75FE"
            ,"#0093AF"
            ,"#0087BD"
            ,"#0018A8"
            ,"#333399"
            ,"#0247FE"
            ,"#A2A2D0"
            ,"#6699CC"
            ,"#0D98BA"
            ,"#064E40"
            ,"#5DADEC"
            ,"#126180"
            ,"#8A2BE2"
            ,"#7366BD"
            ,"#4D1A7F"
            ,"#5072A7"
            ,"#3C69E7"
            ,"#DE5D83"
            ,"#79443B"
            ,"#E3DAC9"
            ,"#006A4E"
            ,"#87413F"
            ,"#CB4154"
            ,"#66FF00"
            ,"#D891EF"
            ,"#C32148"
            ,"#1974D2"
            ,"#FFAA1D"
            ,"#FF55A3"
            ,"#FB607F"
            ,"#004225"
            ,"#CD7F32"
            ,"#88540B"
            ,"#AF6E4D"
            ,"#1B4D3E"
            ,"#7BB661"
            ,"#FFC680"
            ,"#800020"
            ,"#DEB887"
            ,"#A17A74"
            ,"#CC5500"
            ,"#E97451"
            ,"#8A3324"
            ,"#BD33A4"
            ,"#702963"
            ,"#536872"
            ,"#5F9EA0"
            ,"#A9B2C3"
            ,"#91A3B0"
            ,"#006B3C"
            ,"#ED872D"
            ,"#E30022"
            ,"#FFF600"
            ,"#A67B5B"
            ,"#4B3621"
            ,"#A3C1AD"
            ,"#C19A6B"
            ,"#EFBBCC"
            ,"#FFFF99"
            ,"#FFEF00"
            ,"#FF0800"
            ,"#E4717A"
            ,"#00BFFF"
            ,"#592720"
            ,"#C41E3A"
            ,"#00CC99"
            ,"#960018"
            ,"#D70040"
            ,"#FFA6C9"
            ,"#B31B1B"
            ,"#56A0D3"
            ,"#ED9121"
            ,"#00563F"
            ,"#703642"
            
        );

        return $color[$i];
    }

    public function ColorSet6($i = 0)
    {
        $color = array(
            "#F88379"
            ,"#8C92AC"
            ,"#B87333"
            ,"#DA8A67"
            ,"#AD6F69"
            ,"#CB6D51"
            ,"#996666"
            ,"#FF3800"
            ,"#FF7F50"
            ,"#F88379"
            ,"#893F45"
            ,"#FBEC5D"
            ,"#B31B1B"
            ,"#6495ED"
            ,"#FFF8DC"
            ,"#2E2D88"
            ,"#FFF8E7"
            ,"#81613C"
            ,"#FFBCD9"
            ,"#FFFDD0"
            ,"#DC143C"
            ,"#9E1B32"
            ,"#A7D8DE"
            ,"#F5F5F5"
            ,"#00FFFF"
            ,"#00B7EB"
            ,"#58427C"
            ,"#FFD300"
            ,"#F56FA1"
            ,"#666699"
            ,"#654321"
            ,"#5D3954"
            ,"#26428B"
            ,"#008B8B"
            ,"#536878"
            ,"#B8860B"
            ,"#013220"
            ,"#006400"
            ,"#1A2421"
            ,"#BDB76B"
            ,"#483C32"
            ,"#534B4F"
            ,"#543D37"
            ,"#8B008B"
            ,"#4A5D23"
            ,"#556B2F"
            ,"#FF8C00"
            ,"#9932CC"
            ,"#03C03C"
            ,"#301934"
            ,"#8B0000"
            ,"#E9967A"
            ,"#8FBC8F"
            ,"#3C1414"
            ,"#8CBED6"
            ,"#483D8B"
            ,"#2F4F4F"
            ,"#177245"
            ,"#00CED1"
            ,"#9400D3"
            ,"#00703C"
            ,"#555555"
            ,"#DA3287"
            ,"#FAD6A5"
            ,"#B94E48"
            ,"#004B49"
            ,"#FF1493"
            ,"#FF9933"
            ,"#00BFFF"
            ,"#4A646C"
            ,"#7E5E60"
            ,"#1560BD"
            ,"#2243B6"
            ,"#C19A6B"
            ,"#EDC9AF"
            ,"#696969"
            ,"#1E90FF"
            
            
        );

        return $color[$i];
    }
}
