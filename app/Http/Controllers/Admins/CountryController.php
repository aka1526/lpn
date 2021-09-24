<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;

use App\Models\Admins\Accessuid;
use App\Models\Admins\User;
use Carbon\Carbon;
use Cookie;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use App\Models\Admins\Country;

class CountryController extends Controller
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

        $country = Country::orderBy('country_name')->paginate($this->paging);

        return view('admins.pages.country.index', compact('country'));
    }

    function new (Request $request) {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        //  $aboutus = Aboutus::orderBy('aboutus_index')->paginate($this->paging);;

        return view('admins.pages.country.new');
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

                    'country_name' => 'required|string|unique:country,country_name',
                    'country_code' => 'required',

                ],
                [
                    'country_name.required' => ' Name Is Required ',
                    'country_name.unique' => '  Name Is Duplicate ',
                    'country_code.required' => 'Country Code Is Required ',
                ]
            );
          
            $uid = $this->NewUid();
            
           
            $action = Country::insert([
                
                'country_uid' =>  $uid
                , 'country_code'=>  $request->country_code 
                , 'country_code3'=>  $request->country_code3 
                , 'country_name'=>  $request->country_name 
                , 'country_status'=> "Y" 
                , 'created_at'=> Carbon::now()
                , 'updated_at'=> Carbon::now()
            

            ]);

            $img_name =  $this->uploadFile($request);
            if( $img_name !=''){
                Country::where('country_uid', '=', $uid)->update([
                     'country_flag'=>  $request->img_name 
                    ]);
            }
       
        return redirect()->route('country.index');
    
    }

    public function edit(Request $request,$uid=''){
        
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }
 
        $country = Country::where('country_uid','=',$uid)->first();

        return view('admins.pages.country.edit', compact('country'));
    }

    public function update(Request $request){
        
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $fields = $request->validate(
            [

                'country_code' => 'required',
                'country_name' => 'required',
                'country_uid' =>  'required',

            ],
            [
                'country_code.required' => ' Country Code Is Required ',
                'country_uid.required' => 'Country Uid Is Required ',
                'country_name.required' => 'Country Name Is Required ',
            ]
        );
        
         $uid =$request->country_uid;  
        if( $uid !=''){
            Country::where('country_uid', '=', $uid)->update([
                
                 'country_code'=>  $request->country_code 
                , 'country_code3'=>  $request->country_code3 
                , 'country_name'=>  $request->country_name 
                , 'updated_at'=> Carbon::now()
                ]);

                $img_name =  $this->uploadFile($request);
                if( $img_name !=''){
                    Country::where('country_uid', '=', $uid)->update([
                         'country_flag'=>  $request->img_name 
                        ]);
                }
        }

        //$aboutus = Aboutus::orderBy('aboutus_index')->paginate($this->paging);
        return redirect()->route('country.index') ;
      // return view('admins.pages.aboutus_index', compact('aboutus'));
    }

 
    public function uploadFile(Request $request )
    {
        $image = $request->file('fileupload');
        $imagename = '';
        
        if ($image) {
            $imagename = $request->country_code . '.' . $image->extension();

            $filePath = public_path('/images/country/'.$url);
             
            if (!File::exists($filePath)) {

                File::makeDirectory($filePath, 0755, true, true);
            }

       
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(400, 200); //
            $image_resize->save($filePath . '/' . $imagename);

        }

        return $imagename;
    }

     

     
    public function delete(Request $request)
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
         
        $uid =  $request->uid;
        
        $country = Country::where('country_uid', '=', $uid)->first();
        
        $success = false;
        $message = 'fail';
        $response = [];
        if ($country) {
            $success = true;
          
            $message = 'success';
            $success =  Country::where('country_uid', '=', $uid)->delete();
            
        }
        
        return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

 
    public function updatestatus(Request $request)
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
         
        $uid =  $request->uid;
        
        $country = Country::where('country_uid', '=', $uid)->first();
         
        $success = false;
        $message = 'fail';
        $response = [];
        if ($country) {
            $success = true;
             $message = 'success';
              
            $success =  Country::where('country_uid', '=', $uid)->update([
                "country_status" =>  $request->status,
            ]);
            $response = [
                "success" =>  $success,
            ];
           
        }
        
        return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

}
