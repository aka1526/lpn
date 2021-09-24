<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Admins\Aboutus;
use App\Models\Admins\Accessuid;
use App\Models\Admins\User;

use Carbon\Carbon;
use Cookie;
use File;
use Image;

use App\Models\Admins\Khans;

class KhansController extends Controller
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
         
        $khans = Khans::where('khan_uid','!=','')->orderBy('khan_index')->paginate($this->paging);
        
        return view('admins.pages.khan_index', compact('khans'));
    }

    public function edit(Request $request,$uid)
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }
         
        $khans = Khans::where('khan_uid','=',$uid)->first();
        
        return view('admins.pages.khan_edit', compact('khans'));
    }


    public function new(Request $request)
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

       // $khans = Khans::where('khan_uid','!=','')->orderBy('khan_index')->paginate($this->paging);
         
        return view('admins.pages.khan_new' );
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

                    'khan_name' => 'required|string|unique:khans,khan_name',
                     'khan_group' => 'required',

                ],
                [
                    'khan_name.required' => 'Khan Name Is Required ',
                    'khan_name.unique' => 'Khan Name Is Duplicate ',
                    'khan_group.required' => 'khan Group Is Required ',
                ]
            );
          
            $uid = $this->NewUid();
           
            $khan_index= (int)$request->khan_index > 0 ?  $request->khan_index :  Khans::max('khan_index')+1;   
            

            $action = Khans::insert([
                'khan_uid' =>  $uid
                , 'khan_index' => (int)$khan_index
                , 'khan_group' => $request->khan_group
                , 'khan_name' => $request->khan_name
                , 'khan_desc' => $request->khan_desc
                , 'khan_status' => "Y"
                , 'created_at'=> Carbon::now()
                , 'updated_at' =>Carbon::now() 
            ]);

        return redirect()->route('khans.index');
    
    }

  
    public function update(Request $request){
        
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $fields = $request->validate(
            [

                'khan_name' => 'required|string',
                'khan_index' => 'required',
                 'khan_group' => 'required',

            ],
            [
                'khan_name.required' => 'Khan Name Is Required ',
                'khan_index.required' => 'Khan No. Is Required ',
                'khan_group.required' => 'khan Group Is Required ',
            ]
        );
        
        $uid = $request->khan_uid !='' ? $request->khan_uid : '';
        $khan_index=  $request->khan_index  ;   
            
        if( $uid !=''){
            Khans::where('khan_uid', '=', $uid)->update([
                'khan_uid' =>  $uid
                , 'khan_index' => (int)$khan_index
                , 'khan_group' => $request->khan_group
                , 'khan_name' => $request->khan_name
                , 'khan_desc' => $request->khan_desc
                , 'updated_at' =>Carbon::now() 
                ]);

                
        }

        //$aboutus = Aboutus::orderBy('aboutus_index')->paginate($this->paging);
        return redirect()->route('khans.index') ;

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
        
        $khan = Khans::where('khan_uid', '=', $uid)->first();
        
        $success = false;
        $message = 'fail';
        $response = [];
        if ($khan) {
            $success = true;
          
            $message = 'success';
            $success =  Khans::where('khan_uid', '=', $uid)->delete();
            
        }
        
        return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

    
    public function updatestatus(Request $request)
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
         
        $uid =  $request->uid;
        
        $khan = Khans::where('khan_uid', '=', $uid)->first();
         
        $success = false;
        $message = 'fail';
        $response = [];
        if ($khan) {
            $success = true;
             $message = 'success';
              
            $success =  Khans::where('khan_uid', '=', $uid)->update([
                "khan_status" =>  $request->status,
            ]);
            $response = [
                "success" =>  $success,
            ];
           
        }
        
        return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

    

}
