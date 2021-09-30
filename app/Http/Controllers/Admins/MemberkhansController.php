<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admins\Accessuid;
use App\Models\Admins\Country;
use App\Models\Admins\Khans;
use App\Models\Admins\Members;
use App\Models\Admins\Sysinfo;
use App\Models\Admins\User;
use Carbon\Carbon;
use Cookie;
use DNS1D;
use DNS2D;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use App\Models\Admins\Memberkhans;

use App\Http\Controllers\Admins\MembersController;

class MemberkhansController extends Controller
{
    protected $paging = 10;
    protected $useruid = '';
    protected $username = '';
    public function GetUserUid()
    {

        $loginuid = Cookie::get('loginuid') != '' ? Cookie::get('loginuid') : '';
        $useruid = '';
        $Accessuid = 0;
        $Accessuid = Accessuid::where('uid_login', '=', $loginuid)->count();
        if ($Accessuid > 0) {
            $user = User::where('uid_login', '=', $loginuid)
                ->where('user_status', '=', 'Y')->first();

        } else {
            Cookie::queue(Cookie::forget('loginuid'));

        }

        $useruid = isset($user->uid) ? $user->uid : '';
        $this->username = isset($user->uid) ? $user->name : '';
        return $useruid;
    }

    public function NewUid()
    {
        $uuid = (string) Str::uuid();
        $uuid = str_replace("-", "", $uuid);
        return $uuid;
    }

    public function index(Request $request)     {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }
        $search= isset($request->search) ?  trim($request->search) : '';
        //$type= isset($request->type) ?  $request->type : '';
       // dd($request);
        $memberkhans = Memberkhans::select(
            "memberkhans.*", 
            "members.img_profile",
            
        ) ->leftJoin("members", "members.member_uid", "=", "memberkhans.cer_member_uid")
        ->where(function($query) use ($search) {
            if ($search !='') {
                return $query->where('cer_no','like', '%'.$search.'%')
                ->orWhere('cer_member_no','like', '%'.$search.'%')
                ->orWhere('cer_member_fullname','like', '%'.$search.'%');
                
            }
        })->orderBy('cer_year','desc')->orderBy('cer_maxno','desc')->paginate($this->paging);

        return view('admins.pages.memberkhans.index', compact('memberkhans'));
    }

    public function get(Request $request)     {

        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
        $uid =  $request->uid;
        $member = Members::where('member_uid', '=', $uid)->first();
        $success = false;
        $message = 'fail';


        
        $start_khan_no =(int)$member->khan_no > 0 ? (int)$member->khan_no : 0  ;

        $end_khan_no =(int)$member->khan_no + 1;
        $khans = Khans::where('khan_index', '>=', $start_khan_no)
        ->where('khan_index', '<=', $end_khan_no)->orderBy('khan_index')->get();
        
        $html='<select class="form-control" id="khan_no" name="khan_no">';
            foreach ($khans as $item){
                
                    $select  = $end_khan_no == $item->khan_index? ' selected' :'';
                 
                $html .='<option value="'.$item->khan_index.'" '.$select.'>'.$item->khan_name.'</option>';
            }
        $html .='</select>';
        $response = [];
        if ($member) {
            $success = true;
            $message = 'success';
            $response = [
                'member_uid' => $member->member_uid,
                'khan_uid' => $member->khan_uid,
                'khan_no' => $member->khan_no,
                'html' =>  $html,
                'img_idcard' => '/images/members/card/'. $member->img_idcard,
            ];
        }
        return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

    public function new(Request $request)
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }
        $country = Country::where('country_status', '=', 'Y')->orderBy('country_name')->get();
        $khans = Khans::where('khan_status', '=', 'Y')->orderBy('khan_index')->get();
        $krus = Members::where('user_type', '=', 'TEACHERS')->orderBy('full_name')->get();
        $members= Members::where('member_status', '=', 'Y')->where('isdelete','=','N')->orderBy('member_no','desc')->get();
        return view('admins.pages.memberkhans.new', compact('country', 'khans', 'krus','members'));
    }

    public function add(Request $request)    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }
      //   dd($request);
        $success = false;
        $message = 'fail';
        $response = [];
        $course_total = 0;
 
         $fields = $request->validate(
            [

                'certificate_no' => 'required',
                'member_uid' => 'required',
                'khan_no' => 'required',
                'date_issue' => 'required',
                
            ],
            [
                'certificate_no.required' => 'Certificate NO Is Required ',
                'member_uid.required' => 'Member name Is Required ',
                'khan_no.required' => 'Khan  Is Required ',
                'date_issue' => 'Date issue  Is Required ',

            ]
        );
 
        $uid = $this->NewUid();
        //$url= $request->aboutus_url !='' ? $request->aboutus_url  :  str_replace(' ', '-', $request->aboutus_name)  ;
        // $url =strtolower($url);

        // "member_uid" => "fb3142feb70e4f2eb538a1d48096accf"
        // "member_group" => "PERSON"
        // "certificate_no" => null
        // "date_issue" => "2021-09-30"

        $member_uid = isset($request->member_uid) ? $request->member_uid : '';
        $_date = $request->date_issue;
        $date_issue = Carbon::parse($_date)->format('Y-m-d');
        $member_year = Carbon::parse($_date)->format('Y');
        $cer_month = Carbon::parse($_date)->format('m');
        $date_expiry = Carbon::parse($_date)->addYears(1);
         
        $khan_no = (int)$request->khan_no > 0 ? $request->khan_no : 0;
        $khans = Khans::where('khan_index', '=', $khan_no)->first();
       

        $member = Members::where('member_uid','=',$member_uid)->first();

        $cer_year = Carbon::parse($_date)->format('y');
         
        $khan_name = "";
        $khan_uid='';
        if ($khans) {
            $khan_uid = $khans->khan_uid;
            $khan_name = $khans->khan_name;
            $user_type = $khans->khan_group;
        }
 

        // $kru_uid = isset($request->kru_uid) ? $request->kru_uid : '';
        
        // $kru_name = "";
        // if ($kru_uid !='') {
        //     $kru = Members::where('member_uid', '=', $kru_uid)->first();
        //     if( $kru){
        //         $kru_name = $kru->full_name;
        //     }
            
        // }
        $cer_uid =  $this->NewUid();
        $row_uid =  $this->NewUid();  
        $created_by = $this->username ;
        $certificate_no = $request->certificate_no;
        $str_arr = explode("/", $certificate_no);
        $cer_maxno =  $str_arr[1];

        $action =Memberkhans::insert([
            'row_uid' =>$row_uid
           ,  'khan_uid' => $khan_uid
            , 'khan_no' => $khan_no
            , 'khan_name'=>  $khan_name
            , 'cer_uid'=>   $cer_uid
            , 'cer_no' => $certificate_no
            , 'cer_maxno'=> (int)$cer_maxno
            , 'cer_year' => $cer_year
            , 'cer_month'=> $cer_month
            , 'cer_date_issue'=> $date_issue
            , 'cer_member_uid'=> $member_uid
            , 'cer_member_no'=> $member->member_no
            , 'cer_member_fullname'=> $member->full_name
            , 'khan_status' =>'Y' 
            , 'created_by' => $created_by
            , 'created_at'=>Carbon::now()
            , 'updated_at' =>Carbon::now()
        ]);
 
        if($action){
            
            if($khan_no>0){
                Members::where('member_uid','=',$member_uid)->update([
                    'khan_uid' => $khan_uid
                  , 'khan_no' => $khan_no
                  , 'khan_name' => $khan_name
                  , 'certificate_no' => $certificate_no
                  , 'user_type' => $user_type
                  , 'date_expiry' => $date_expiry
                  , 'date_renew' =>  $date_issue
                  , 'updated_at' => Carbon::now()
              ]);
            }
            
        }
       
        $memberCard = new MembersController();
        $url="/pageadmin/memberkhans";
        $card_renew = $memberCard->idcardimg($request,$member_uid,$url) ;
          
        if($card_renew){
            $member = Members::where('member_uid','=',$member_uid)->first();
            Memberkhans::where('row_uid','=',$row_uid)->update([
                'card_img' => $member->img_idcard
            ]);
        }

        // if ($img_name != '') {
        //     $act = Members::where('member_uid', '=', $uid)->update([
        //         'img_profile' => $img_name,
        //     ]);

        //     if ($act) {
        //         $this->idcardimg($request,$uid);
        //     }

        // }
 
       // return  redirect()->to('/pageadmin/memberkhans/prosonal/edit/'.$uid);
        return redirect()->route('memberkhans.index');

    }

 
    
}
