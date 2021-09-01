<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admins\Accessuid;
use App\Models\Admins\Slidepage;
use App\Models\Admins\User;
use Carbon\Carbon;
use Cookie;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class SlidepageController extends Controller
{
    protected $paging = 10;
    protected $useruid = '';

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

        return $useruid;
    }

    public function NewUid()
    {
        $uuid = (string) Str::uuid();
        $uuid = str_replace("-", "", $uuid);
        return $uuid;
    }

    public function index(Request $request, $courseuid = '')
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $slidepage = Slidepage::where('slidepages_uid', '!=', '')->orderBy('slidepages_index')->paginate($this->paging);

        return view('admins.pages.slidepage_index', compact('slidepage'));
    }

    function new (Request $request) {

        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        return view('admins.pages.slidepage_new');
    }

    public function add(Request $request)
    {

        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $fields = $request->validate(
            [

                'slidepages_headline' => 'required|string',
                'slidepages_header' => 'required|string',
                'slidepages_detail' => 'required',
                'slidepages_link' => 'required|string',

            ],
            [
                'slidepages_headline.required' => ' Headline Is Required For Your Information ',
                'slidepages_header.required' => 'Header Is Required For Your Information',
                'slidepages_detail.required' => 'Detail Is Required For Your Information Safety.',
                'slidepages_link.required' => ' Url Is Required For Your Information ',

            ]
        );
        $imagename = $this->uploadFile($request);

        $uid = $this->NewUid();
        $index = Slidepage::count();

        $slidepage = Slidepage::create([
            'slidepages_uid' => $uid,
            'slidepages_index' => (int) $index + 1,
            'slidepages_headline' => $request->slidepages_headline,
            'slidepages_header' => $request->slidepages_header,
            'slidepages_detail' => $request->slidepages_detail,
            'slidepages_link' => $request->slidepages_link,

            'slidepages_status' => $request->slidepages_status,
            'created_at' => Carbon::now(),
            'update_at' => Carbon::now(),
        ]);

        if ($imagename != '') {

            Slidepage::where('slidepages_uid', '=', $uid)->update([
                'slidepages_img' => $imagename,
            ]);

        }

        return redirect()->route('slidepage.index');

    }

    public function uploadFile(Request $request)
    {
        $image = $request->file('fileupload');
        $imagename = '';
        if ($image) {
            $imagename = time() . '.' . $image->extension();

            $filePath = public_path('/images/slidepage');
            $filePath_thumbnails = public_path('/images/slidepage/thumbnails');
            if (!File::exists($filePath_thumbnails)) {

                File::makeDirectory($filePath_thumbnails, 0755, true, true);
            }

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(1924, 761); //
            $image_resize->save($filePath_thumbnails . '/' . $imagename);

            $image_resize->resize(1924, 761); //
            $image_resize->save($filePath . '/' . $imagename);
        }

        return $imagename;
    }

    public function edit(Request $request, $uid = '')
    {

        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $slidepage = Slidepage::where('slidepages_uid', '=', $uid)->first();

        return view('admins.pages.slidepage_edit', compact('slidepage', 'uid'));
    }

    public function update(Request $request)
    {

        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $fields = $request->validate(
            [
                'slidepages_index' => 'required',
                'slidepages_headline' => 'required|string',
                'slidepages_link' => 'required|string',
                'slidepages_header' => 'required|string',

            ],
            [
                'slidepages_index.required' => ' index Is Required For Your Information ',
                'slidepages_headline.required' => ' headline Is Required For Your Information ',
                'slidepages_link.required' => ' Url Is Required For Your Information ',
                'slidepages_header.required' => 'header Is Required For Your Information',
                'slidepages_detail.required' => 'detail Is Required For Your Information Safety.',

            ]
        );

        $uid = $request->slidepages_uid;

        $slidepage = Slidepage::where('slidepages_uid', '=', $uid)->first();

        $imagename = $this->uploadFile($request);
        $index = $request->slidepages_index;
        if ($slidepage) {
            $Action = Slidepage::where('slidepages_uid', '=', $uid)->update([

                'slidepages_index' => $index,
                'slidepages_headline' => $request->slidepages_headline,
                'slidepages_header' => $request->slidepages_header,
                'slidepages_detail' => $request->slidepages_detail,
                'slidepages_link' => $request->slidepages_link,
                'slidepages_status' => $request->slidepages_status,
                'update_at' => Carbon::now(),
            ]);
        }

        if ($imagename != '') {

            Slidepage::where('slidepages_uid', '=', $uid)->update([
                'slidepages_img' => $imagename,
            ]);

        }

        return redirect()->route('slidepage.index');

    }

    public function status(Request $request )
    {

        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        
        $uid= $request->uid;
        $status= $request->status;
       
        $slidepage = Slidepage::where('slidepages_uid', '=', $uid)->first();
        $message='fail';
        if($slidepage ){
            $message='success';
            $success = Slidepage::where('slidepages_uid', '=', $uid)->update([
                'slidepages_status' => $status,
            ]);  
        }

        //return view('admins.pages.slidepage_index');
       return response()->json(['success' => $success, 'message' =>  $message], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    
    }

    public function delete(Request $request )
    {

        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        
        $uid= $request->uid;
        $status= $request->status;
       
        $slidepage = Slidepage::where('slidepages_uid', '=', $uid)->first();
        $message='fail';
        if($slidepage ){
            $message='success';
            $success = Slidepage::where('slidepages_uid', '=', $uid)->delete();  
        }

        //return view('admins.pages.slidepage_index');
       return response()->json(['success' => $success, 'message' =>  $message], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    
    }

}
