<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admins\Accessuid;
use App\Models\Admins\Country;
use App\Models\Admins\Members;
use App\Models\Admins\Organizations;
use App\Models\Admins\User;
use Carbon\Carbon;
use Cookie;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class OrganizationsController extends Controller
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
        $search =$request->search ;
        
        $organizations = Organizations::where(function ($query) use ($search) {
            if ($search != '') {
                  $query->orwhere('org_name', 'like', '%' . $search . '%');
                  $query->orwhere('org_country_name', 'like', '%' . $search . '%');
            }
        })->orderBy('org_name')->paginate($this->paging);

        return view('admins.pages.organizations.index', compact('organizations'));
    }

    function new (Request $request) {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        //  $aboutus = Aboutus::orderBy('aboutus_index')->paginate($this->paging);;
        $krus = Members::where('user_type', '=', 'TEACHERS')->orderBy('full_name')->get();
        $country = Country::where('country_status', '=', 'Y')->orderBy('country_name')->get();
        return view('admins.pages.organizations.new', compact('country', 'krus'));
    }

    public function get(Request $request)
    {

        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }
        $uid = $request->uid;
        $member = Organizations::where('org_uid', '=', $uid)->first();
        $success = false;
        $message = 'fail';

        $response = [];
        if ($member) {
            $success = true;
            $message = 'success';
            $response = [
                'org_uid' => $member->org_uid,
                'org_name' => $member->org_name ,
                'org_date_validate' => $member->org_date_validate,
                'org_date_exp' => $member->org_date_exp,
                'org_logo' => '/images/logo/thumbnails/' . $member->org_logo,
            ];
        }

        return response()->json(['success' => $success, 'message' => $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }


    public function add(Request $request)
    {
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

                'org_name' => 'required|string|unique:organizations,org_name',
                'org_date_register' => 'required',
                'org_country_uid' => 'required',

            ],
            [
                'org_name.required' => 'organizations Name Is Required ',
                'org_name.unique' => 'organizations Name Is Duplicate ',
                'org_date_register.required' => 'Date Is Required ',
                'org_country_uid.required' => 'Country Name Is Required ',
            ]
        );
        $created_by = $this->username;
        $uid = $this->NewUid();
        $img_name = $this->uploadLogo($request);
        $country_uid = $request->org_country_uid;
        $country = Country::where('country_uid', '=', $country_uid)->first();
        //dd($country);
        $action = Organizations::insert([

            "org_uid" => $uid
            , "org_type" => $request->org_type
            , "org_www" => $request->org_www
            , "org_facebook" => $request->org_facebook
            , "org_name" => $request->org_name
            , "org_name_teachers" => $request->org_name_teachers
            , "org_country_uid" => $country_uid
            , "org_country_code" => $country->country_code
            , "org_country_name" => $country->country_name
            , "org_date_register" => $request->org_date_register
            , "org_email" => $request->org_email_
            , "org_tel" => $request->org_tel
            , "org_address" => $request->org_address
            , "org_profile" => $request->org_profile
            , "org_status" => "Y"
            , "created_by" => $created_by
            , "updated_by" => $created_by
            , 'created_at' => Carbon::now()
            , 'updated_at' => Carbon::now(),

        ]);

        if ($img_name != '') {
            Organizations::where('org_uid', '=', $uid)->update([
                'org_logo' => $img_name,
            ]);
        }

        return redirect()->route('org.index');

    }

    public function edit(Request $request, $uid = '')
    {

        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $krus = Members::where('user_type', '=', 'TEACHERS')->orderBy('full_name')->get();
        $country = Country::where('country_status', '=', 'Y')->orderBy('country_name')->get();
        $dtEdit = Organizations::where('org_uid', '=', $uid)->first();

        return view('admins.pages.organizations.edit', compact('dtEdit', 'krus', 'country'));
    }

    public function update(Request $request)
    {
 
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $fields = $request->validate(
            [
                'org_uid' => 'required',
                'org_name' => 'required',
                'org_date_register' => 'required',
                'org_country_uid' => 'required',

            ],
            [
                'org_uid.required' => 'organizations Name Is Required ',
                'org_name.required' => 'organizations Name Is Required ',
                'org_date_register.required' => 'Date Is Required ',
                'org_country_uid.required' => 'Country Name Is Required ',
            ]
        );

        $uid = $request->org_uid != '' ? $request->org_uid : '';
        $created_by = $this->username;
        $country_uid = $request->org_country_uid;
        $country = Country::where('country_uid', '=', $country_uid)->first();

        if ($uid != '') {
            Organizations::where('org_uid', '=', $uid)->update([
                "org_www" => $request->org_www
                , "org_facebook" => $request->org_facebook
                , "org_name" => $request->org_name
                , "org_name_teachers" => $request->org_name_teachers
                , "org_country_uid" => $country_uid
                , "org_country_code" => $country->country_code
                , "org_country_name" => $country->country_name
                , "org_date_register" => $request->org_date_register
                , "org_email" => $request->org_email_
                , "org_tel" => $request->org_tel
                , "org_address" => $request->org_address
                , "org_profile" => $request->org_profile
                , "org_status" => "Y"
                , "updated_by" => $created_by
                , 'updated_at' => Carbon::now(),
            ]);

            $img_name = $this->uploadLogo($request);
            if ($img_name != '') {
                Organizations::where('org_uid', '=', $uid)->update([
                    'org_logo' => $img_name,
                ]);
            }
        }

        //$aboutus = Aboutus::orderBy('aboutus_index')->paginate($this->paging);
        return redirect()->route('org.index');
        // return view('admins.pages.aboutus_index', compact('aboutus'));
    }

    public function uploadLogo(Request $request, $uid = '')
    {
        $image = $request->file('fileupload');
        $uid = $uid != '' ? $uid : $request->course_uid;
        $imagename = '';
        if ($image) {
            $imagename = time() . '.' . $image->extension();

            $filePath = public_path('/images/logo/' . $uid);
            $filePath_thumbnails = public_path('/images/logo/' . $uid . '/thumbnails');
            if (!File::exists($filePath_thumbnails)) {

                File::makeDirectory($filePath_thumbnails, 0755, true, true);
            }

            $image_thumbnail = Image::make($image->getRealPath());
            $image_thumbnail->resize(260, 200); //
            $image_thumbnail->save($filePath_thumbnails . '/' . $imagename);

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(400, 380); //
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

            $filePath = public_path('/images/aboutus/' . $url);
            $filePath_thumbnails = public_path('/images/aboutus/' . $url . '/thumbnails');
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

    public function updatestatus(Request $request)
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $uid = $request->uid;
        $status= $request->status;
        $Organizations = Organizations::where('org_uid', '=', $uid)->first();

        $success = false;
        $message = 'fail';
        $response = [];
        if ($Organizations) {
            $success = true;

            $message = 'success';
            $success = Organizations::where('org_uid', '=', $uid)->update([
                "org_status" => $status
            ]);

        }

        return response()->json(['success' => $success, 'message' => $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }


    public function delete(Request $request)
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $uid = $request->uid;

        $Organizations = Organizations::where('org_uid', '=', $uid)->first();

        $success = false;
        $message = 'fail';
        $response = [];
        if ($Organizations) {
            $success = true;

            $message = 'success';
            $success = Organizations::where('org_uid', '=', $uid)->delete();

        }

        return response()->json(['success' => $success, 'message' => $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }


    public function RenewMember(Request $request)
    {
       
        
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $uid = $request->org_uid;
        $date_renew= $request->date_renew;
        $date_exp =   Carbon::parse($date_renew)->addYears(1);
        $Organizations = Organizations::where('org_uid', '=', $uid)->first();

        $success = false;
        $message = 'fail';
        $response = [];
        if ($Organizations) {
            $success = true;

            $message = 'success';
            $success = Organizations::where('org_uid', '=', $uid)->update([
                "org_date_validate" =>  $date_renew,
                "org_date_exp" => $date_exp,
            ]);

        }

        return response()->json(['success' => $success, 'message' => $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
     
    }

    public function getorganization(Request $request)
    {
       
        
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $country_code = $request->country_code;
        
        $Organizations = Organizations::where('org_country_code', '=', $country_code)
        ->orderBy('org_name')->get();

        $success = false;
        $message = 'fail';
        $response = "";
        if ($Organizations) {
            $success = true;

            $message = 'success';
            $success = true;
            
               $i=0; 
            foreach( $Organizations as $item){
                $i++;
                $response .='
                    <tr>
                        <td>'. $i.'</td>
                        <td class="tx-right tx-medium tx-inverse">'.$item->org_name.'</td>
                        <td>'.$item->org_name_teachers.'</td>
                        <td class="tx-right tx-medium tx-danger">'.$item->org_www.'</td>
                        <td class="tx-right tx-medium tx-danger">'.$item->org_email.'</td>
                    </tr>';

            } 


        }

        return response()->json(['success' => $success, 'message' => $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
     
    }

    

}
