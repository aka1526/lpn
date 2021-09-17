<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admins\Aboutus;
use App\Models\Admins\Accessuid;
use App\Models\Admins\User;
use Carbon\Carbon;
use Cookie;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class AboutusController extends Controller
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

    public function index(Request $request)
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $aboutus = Aboutus::orderBy('aboutus_index')->paginate($this->paging);

        return view('admins.pages.aboutus_index', compact('aboutus'));
    }

    function new (Request $request) {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        //  $aboutus = Aboutus::orderBy('aboutus_index')->paginate($this->paging);;

        return view('admins.pages.aboutus_new');
    }

    public function add(Request $request)    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }
       
        $success = false;
        $message = 'fail';
        $response = [];
        $course_total = 0;
       
          $fields = $request->validate(
                [

                    'aboutus_name' => 'required|string|unique:aboutus,aboutus_name',
                   // 'aboutus_desc' => 'required',

                ],
                [
                    'aboutus_name.required' => 'Page Name Is Required ',
                    'aboutus_name.unique' => 'Page Name Is Duplicate ',
                  //  'aboutus_desc.required' => 'Page Name Is Required ',
                ]
            );
          
            $uid = $this->NewUid();
            $url= $request->aboutus_url !='' ? $request->aboutus_url  :  str_replace(' ', '-', $request->aboutus_name)  ;
            $img_name =  $this->uploadFile($request, $url);
            $aboutus_index= Aboutus::max('aboutus_index')+1;   
           
            $action = Aboutus::insert([
                'aboutus_uid'=>  $uid,
                'aboutus_index'=> (int)$aboutus_index,
                'aboutus_name' => $request->aboutus_name,
                'aboutus_header'=>  $request->aboutus_header,
                'aboutus_desc'=>  $request->aboutus_desc,
                'aboutus_url' =>  strtolower($url),
                 
                'aboutus_status'=> "Y",
                'aboutus_icon' =>"", 
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);

            if( $img_name !=''){
                Aboutus::where('aboutus_uid', '=', $uid)->update([
                    'aboutus_img' => $img_name
                    ]);
            }
       
        return redirect()->route('aboutus.index');
    
    }

    public function edit(Request $request,$uid=''){
        
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $aboutus = Aboutus::where('aboutus_uid','=',$uid)->first();

        return view('admins.pages.aboutus_edit', compact('aboutus'));
    }

    public function update(Request $request){
        
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $fields = $request->validate(
            [

                'aboutus_name' => 'required',
                'aboutus_desc' => 'required',
                'aboutus_uid' =>  'required',

            ],
            [
                'aboutus_name.required' => 'Page Name Is Required ',
                'aboutus_uid.required' => 'Page Uid Is Required ',
                'aboutus_desc.required' => 'Page Name Is Required ',
            ]
        );
        
        $uid = $request->aboutus_uid !='' ? $request->aboutus_uid : '';
        $url= $request->aboutus_url !='' ? $request->aboutus_url  :  str_replace(' ', '-', $request->aboutus_name)  ;

        if( $uid !=''){
            Aboutus::where('aboutus_uid', '=', $uid)->update([
                'aboutus_index'=> $request->aboutus_index,
                'aboutus_name' => $request->aboutus_name,
                'aboutus_header'=>  $request->aboutus_header,
                'aboutus_desc'=>    $request->aboutus_desc ,
                'aboutus_url' => strtolower($url) ,
                ]);

                $img_name =  $this->uploadFile($request, $url);
                if( $img_name !=''){
                    Aboutus::where('aboutus_uid', '=', $uid)->update([
                        'aboutus_img' => $img_name
                        ]);
                }
        }

        //$aboutus = Aboutus::orderBy('aboutus_index')->paginate($this->paging);
        return redirect()->route('aboutus.index') ;
      // return view('admins.pages.aboutus_index', compact('aboutus'));
    }


public function uploadimg(Request $request, $uid = '')
{
    $image = $request->file('fileupload');
    $uid = $uid != '' ? $uid : $request->course_uid;
    $imagename = '';
    if ($image) {
        $imagename = time() . '.' . $image->extension();

        $filePath = public_path('/images/course/' . $uid);
        $filePath_thumbnails = public_path('/images/course/' . $uid . '/thumbnails');
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

    public function uploadFile(Request $request, $url = '')
    {
        $image = $request->file('fileupload');
        $imagename = '';

        if ($image) {
            $imagename = time() . '.' . $image->extension();

            $filePath = public_path('/images/aboutus/'.$url);
            $filePath_thumbnails = public_path('/images/aboutus/'.$url. '/thumbnails');
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

    public function convertHtml($body_content) {
        $body_content = trim($body_content);
        $body_content = stripslashes($body_content);
        $body_content = htmlspecialchars($body_content);
        return $body_content;
     } 

     
    public function delete(Request $request)
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
         
        $uid =  $request->uid;
        
        $aboutus = Aboutus::where('aboutus_uid', '=', $uid)->first();
        
        $success = false;
        $message = 'fail';
        $response = [];
        if ($aboutus) {
            $success = true;
          
            $message = 'success';
            $success =  Aboutus::where('aboutus_uid', '=', $uid)->delete();
            
        }
        
        return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }


}
