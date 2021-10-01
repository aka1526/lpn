<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admins\Accessuid;
use App\Models\Admins\Sysinfo;
use App\Models\Admins\User;
use Carbon\Carbon;
use Cookie;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use App\Models\Admins\Rankings;
use App\Models\Admins\Rankingslist;

class RankingsController extends Controller
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
        $rankings = Rankings::where('rank_uid','!=','')
        ->orderBy('rank_index')->paginate($this->paging);

        return view('admins.pages.rankings.index', compact('rankings'));
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
        // $country = Country::where('country_status', '=', 'Y')->orderBy('country_name')->get();
        // $khans = Khans::where('khan_status', '=', 'Y')->orderBy('khan_index')->get();
        // $krus = Members::where('user_type', '=', 'TEACHERS')->orderBy('full_name')->get();
        // $members= Members::where('member_status', '=', 'Y')->where('isdelete','=','N')->orderBy('member_no','desc')->get();
        return view('admins.pages.rankings.new');
    }

    public function add(Request $request)    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }
       //dd($request);
        $success = false;
        $message = 'fail';
        $response = [];
        $course_total = 0;
 
         $fields = $request->validate(
            [

                'rankings_weight' => 'required',
                'rankings_weight_desc' => 'required',
                'rank_gander' => 'required',
                
                
            ],
            [
                'rankings_weight.required' => 'weight NO Is Required ',
               
                'rankings_weight_desc.required' => 'Description Is Required ',
                'rank_gander.required' => 'Gander Is Required ',
                 
            ]
        );
 
       
        $created_by = $this->username ;  
        $uid = $this->NewUid();
        $rank_index = Rankings::where('rank_gander','=',$request->rank_gander)->max('rank_index')+1 ;

       $imagename = $this->uploadFile($request);
        $action =Rankings::insert([

            "rank_uid" =>  $uid

            ,"rank_index" => $rank_index
            ,"rank_gander" =>$request->rank_gander
            ,"rankings_weight" => $request->rankings_weight
            ,"rankings_weight_desc" => $request->rankings_weight_desc
            ,"world_vacant" => $request->world_vacant
            ,"world_won_title" =>  $request->world_won_title
            ,"world_last_defense" => $request->world_last_defense
           , "international_vacant" => $request->international_vacant
            ,"international_won_title" => $request->international_won_title
            ,"international_last_defense" => $request->international_last_defense
            , 'created_by' => $created_by
            , 'created_at'=>Carbon::now()
            , 'updated_at' =>Carbon::now()
        ]);
 
        if($imagename!=''){
            Rankings::where('rank_uid','=',$uid)->update([
                "rank_img" => $imagename
            ]);
              
        }
         
        return redirect()->route('rankings.index');

    }

    public function edit(Request $request,$uid)
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }
         
        $rankings = Rankings::where('rank_uid','=',$uid)->first();
        
        return view('admins/pages/rankings/edit', compact('rankings'));
    }

    public function update(Request $request)    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }
       // dd($request);
        $success = false;
        $message = 'fail';
        $response = [];
        $course_total = 0;
 
         $fields = $request->validate(
            [

                'rankings_weight' => 'required',
                'rankings_weight_desc' => 'required',
                'rank_gander' => 'required',
                
                
            ],
            [
                'rankings_weight.required' => 'weight NO Is Required ',
                'rankings_weight_desc.required' => 'Description Is Required ',
                'rank_gander.required' => 'Gander Is Required ',
                 
            ]
        );
        

       
        $created_by = $this->username ;  
        $uid =$request->rank_uid ;
        $rank_index = $request->rank_index >0 ? $request->rank_index : Rankings::max('rank_index')+1 ;

        $imagename = $this->uploadFile($request);

        $action =Rankings::where('rank_uid','=',$uid)->update([
 
            "rank_index" => $rank_index
            ,"rank_gander" =>$request->rank_gander
            //,"rankings_weight" => $request->rankings_weight
            ,"rankings_weight_desc" => $request->rankings_weight_desc
            ,"world_vacant" => $request->world_vacant
            ,"world_won_title" =>  $request->world_won_title
            ,"world_last_defense" => $request->world_last_defense
           , "international_vacant" => $request->international_vacant
            ,"international_won_title" => $request->international_won_title
            ,"international_last_defense" => $request->international_last_defense
            , 'created_by' => $created_by
            , 'updated_at' =>Carbon::now()
        ]);
 
        if($imagename!=''){
            Rankings::where('rank_uid','=',$uid)->update([
                "rank_img" => $imagename
            ]);
              
        }
         
        return redirect()->route('rankings.index');

    }

    public function uploadFile(Request $request )
    {
        $image = $request->file('fileupload');
       
        $imagename = '';
        if ($image) {
            $imagename = time() . '.' . $image->extension();
            $_path="/images/rankings";
            $filePath = public_path( $_path);
            $filePath_thumbnails = public_path( $_path.'/thumbnails');
            if (!File::exists($filePath_thumbnails)) {

                File::makeDirectory($filePath_thumbnails, 0755, true, true);
            }

            $image_thumbnail = Image::make($image->getRealPath());
            $image_thumbnail->resize(300, 450); //
            $image_thumbnail->save($filePath_thumbnails . '/' . $imagename);
            
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(700, 900); //
            $image_resize->save($filePath . '/' . $imagename);
            
        }

        return $imagename;
    }

    public function list(Request $request,$uid)
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }
         
        $rankings = Rankings::where('rank_uid','=',$uid)->first();
         $rankingslist= Rankingslist::where('list_ref','=',$uid)
         ->orderBy('list_index')->get();
        return view('admins/pages/rankings/list', compact('rankings','rankingslist'));
    }
    
    public function add_list(Request $request)
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }
        $fields = $request->validate(
            [

                'contenders' => 'required',
                
                
            ],
            [
                'contenders.required' => 'weigcontendersht Is Required ',
               
            ]
        );
       $rank_uid = $request->rank_uid;
       $rankings = Rankings::where('rank_uid','=',$rank_uid)->first();
       
       if($rankings ){
            
        $created_by = $this->username ;  
        $uid = $this->NewUid();
        $list_index = Rankingslist::where('list_ref','=',$rank_uid)->max('list_index')+1 ;

        $action =Rankingslist::insert([
            'list_uid'=> $uid
            , 'list_ref'=> $rank_uid
            , 'list_index'=>  $list_index
            , 'contenders'=> $request->contenders
            , 'created_by'=> $created_by
            , 'updated_by'=> $created_by
            , 'created_at'=>Carbon::now()
            , 'updated_at'=> Carbon::now()
 
        ]);

        }
    

        
        return   redirect()->back();
    }

    

    
}
