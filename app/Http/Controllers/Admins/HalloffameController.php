<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admins\Accessuid;
use App\Models\Admins\Halloffames;
use App\Models\Admins\User;
use Carbon\Carbon;
use Cookie;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class HalloffameController extends Controller
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

    public function index(Request $request)
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }
        $search = isset($request->search) ? trim($request->search) : '';
        //$type= isset($request->type) ?  $request->type : '';
        // dd($request);
        $halloffames = Halloffames::where('hof_uid', '!=', '')
            ->where(function ($query) use ($search) {
                if ($search != '') {
                    return $query->where('hof_title', 'like', '%' . $search . '%');
                }
            })
            ->orderBy('hof_index')->paginate($this->paging);

        return view('admins.pages.halloffame.index', compact('halloffames'));
    }

    public function get(Request $request)
    {

        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }
        $uid = $request->uid;
        $member = Members::where('member_uid', '=', $uid)->first();
        $success = false;
        $message = 'fail';

        $start_khan_no = (int) $member->khan_no > 0 ? (int) $member->khan_no : 0;

        $end_khan_no = (int) $member->khan_no + 1;
        $khans = Khans::where('khan_index', '>=', $start_khan_no)
            ->where('khan_index', '<=', $end_khan_no)->orderBy('khan_index')->get();

        $html = '<select class="form-control" id="khan_no" name="khan_no">';
        foreach ($khans as $item) {

            $select = $end_khan_no == $item->khan_index ? ' selected' : '';

            $html .= '<option value="' . $item->khan_index . '" ' . $select . '>' . $item->khan_name . '</option>';
        }
        $html .= '</select>';
        $response = [];
        if ($member) {
            $success = true;
            $message = 'success';
            $response = [
                'member_uid' => $member->member_uid,
                'khan_uid' => $member->khan_uid,
                'khan_no' => $member->khan_no,
                'html' => $html,
                'img_idcard' => '/images/members/card/' . $member->img_idcard,
            ];
        }
        return response()->json(['success' => $success, 'message' => $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

    function new (Request $request) {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }
        return view('admins.pages.halloffame.new');
    }

    public function add(Request $request)
    {
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

                'hof_title' => 'required',
                'hof_content' => 'required',
                'fileupload' => 'required|mimes:jpg,png,jpeg|max:2048',

            ],
            [
                'hof_title.required' => 'weight NO Is Required ',

                'hof_content.required' => 'Description Is Required ',
                'fileupload.required' => 'Gander Is Required ',

            ]
        );

        $created_by = $this->username;
        $uid = $this->NewUid();
        $hof_index = Halloffames::max('hof_index') + 1;
       $hof_slug= strtolower(strtoupper( str_replace(' ', '-', $request->hof_title) )) ; 
        $action = Halloffames::insert([

            "hof_uid" => $uid
            , "hof_index" => $hof_index
            , "hof_title" => $request->hof_title
            , "hof_content" => $request->hof_content
            , "hof_date" => Carbon::now()->format('Y-m-d')
            , 'created_by' => $created_by
            , 'content_status' =>  "Y"
            ,"hof_slug" =>   $hof_slug
            , 'created_at' => Carbon::now()
            , 'updated_at' => Carbon::now(),
        ]);

        $imagename = $this->uploadFile($request);

        if ($imagename != '') {
            Halloffames::where('hof_uid', '=', $uid)->update([
                "hof_img" => $imagename,
            ]);

        }

        return redirect()->route('halloffame.index');

    }

    public function edit(Request $request, $uid)
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $halloffames = Halloffames::where('hof_uid', '=', $uid)->first();

        return view('admins/pages/halloffame/edit', compact('halloffames'));
    }

    public function update(Request $request)
    {
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

                'hof_uid' => 'required',
                'hof_title' => 'required',
                'hof_content' => 'required',

            ],
            [
                'hof_uid.required' => 'weight NO Is Required ',
                'rankhof_titleings_weight_desc.required' => 'Description Is Required ',
                'hof_content.required' => 'Gander Is Required ',

            ]
        );

        $created_by = $this->username;
        $uid = $request->hof_uid;
        $hof_index = $request->hof_index > 0 ? $request->hof_index : Halloffames::max('hof_index') + 1;
        $hof_slug= strtolower(strtoupper( str_replace(' ', '-', $request->hof_title) )) ; 
        $imagename = $this->uploadFile($request);

        $action = Halloffames::where('hof_uid', '=', $uid)->update([
            "hof_index" => $hof_index
            , "hof_title" => $request->hof_title
            , "hof_content" => $request->hof_content
            ,"hof_slug" =>   $hof_slug
            , 'created_by' => $created_by
            , 'content_status' =>  "Y"
            
            , 'updated_at' => Carbon::now(),
        ]);

        if ($imagename != '') {
            Halloffames::where('hof_uid', '=', $uid)->update([
                "hof_img" => $imagename,
            ]);

        }

        return redirect()->route('halloffame.index');

    }

    public function uploadFile(Request $request)
    {
        $image = $request->file('fileupload');

        $imagename = '';
        if ($image) {
            $imagename = time() . '.' . $image->extension();
            $_path = "/images/halloffame";
            $filePath = public_path($_path);
            $filePath_thumbnails = public_path($_path . '/thumbnails');
            if (!File::exists($filePath_thumbnails)) {

                File::makeDirectory($filePath_thumbnails, 0755, true, true);
            }

            $image_thumbnail = Image::make($image->getRealPath());
            $image_thumbnail->resize(450, 300); //
            $image_thumbnail->save($filePath_thumbnails . '/' . $imagename);

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(900, 700); //
            $image_resize->save($filePath . '/' . $imagename);

        }

        return $imagename;
    }

}
