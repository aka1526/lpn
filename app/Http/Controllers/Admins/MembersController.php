<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admins\Aboutus;
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

class MembersController extends Controller
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

        $members = Members::where('member_group', '=', 'PERSON')->orderBy('max_no')->paginate($this->paging);

        return view('admins.pages.members.index', compact('members'));
    }

    public function org(Request $request)
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $members = Members::where('member_group', '=', 'ORGANIZATION')->orderBy('member_no')->paginate($this->paging);

        return view('admins.pages.members_index', compact('members'));
    }

    public function register(Request $request)
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }
        $country = Country::where('country_status', '=', 'Y')->orderBy('country_name')->get();
        $khans = Khans::where('khan_status', '=', 'Y')->orderBy('khan_index')->get();
        $krus = Members::where('user_type', '=', 'TEACHERS')->orderBy('full_name')->get();
        return view('admins.pages.members.new', compact('country', 'khans', 'krus'));
    }

    public function add(Request $request)
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $success = false;
        $message = 'fail';
        $response = [];
        $course_total = 0;

        $fields = $request->validate(
            [

                'first_name' => 'required',
                'gender' => 'required',
                'date_register' => 'required',
                'country_uid' => 'required',

            ],
            [
                'gender.required' => 'Gender Is Required ',
                'first_name.required' => 'first name Is Required ',
                'date_register.required' => 'date register   Is Required ',
                'country_uid.required' => 'country  Is Required ',

            ]
        );

        $uid = $this->NewUid();
        //$url= $request->aboutus_url !='' ? $request->aboutus_url  :  str_replace(' ', '-', $request->aboutus_name)  ;
        // $url =strtolower($url);

        $max_no = Members::max('max_no') + 1;
        $_date = $request->date_register;
        $date_register = Carbon::parse($_date)->format('Y-m-d');
        $member_year = Carbon::parse($_date)->format('Y');
        $member_month = Carbon::parse($_date)->format('m');
        $date_expiry = Carbon::parse($_date)->addYears(1);
        $khan_uid = $request->khan_uid;
        $khans = Khans::where('khan_uid', '=', $khan_uid)->first();
        $khan_no = 0;

        $max_no = Members::max('max_no') + 1;
        $member_yy = Carbon::parse($_date)->format('y');
        $member_no = $this->getIdCard($max_no, 'PLN-' . $member_yy);
        $khan_name = "";
        if ($khans) {
            $khan_no = $khans->khan_index;
            $khan_name = $khans->khan_name;
        }
        $country_uid = $request->country_uid;
        $country = Country::where('country_uid', '=', $country_uid)->first();

        $user_type = strtoupper($request->user_type);

        if ($user_type == 'MEMBERS') {
            $khan_no = 0;
            $khan_name = "";
            $khan_uid = "";
        }

        $kru_uid = isset($request->kru_uid) ? $request->kru_uid : '';
        
        $kru_name = "";
        if ($kru_uid !='') {
            $kru = Members::where('member_uid', '=', $kru_uid)->first();
            if( $kru){
                $kru_name = $kru->full_name;
            }
            
        }

        $certificate_no = $request->certificate_no;

        $action = Members::insert([
            'member_uid' => $uid
            , 'first_name' => strtoupper($request->first_name)
            , 'last_name' => strtoupper($request->last_name)
            , 'full_name' => strtoupper($request->first_name . ' ' . $request->last_name) 
            , 'gender' => $request->gender
            , 'dateofbirth' => $request->dateofbirth
            , 'user_tel' => $request->user_tel
            , 'khan_uid' => $khan_uid
            , 'khan_no' => $khan_no
            , 'khan_name' => $khan_name
            , 'certificate_no' => $certificate_no
            , 'kru_uid' => $kru_uid
            , 'under_kru' => $kru_name
            , 'club_uid' => $request->club_uid
            , 'club_name' => $request->club_name
            , 'user_address' => $request->user_address
            , 'country_uid' => $country_uid
            , 'country_code' => $country->country_code
            , 'country_name' => $country->country_name
            , 'user_facebook' => $request->user_facebook
            , 'user_ig' => $request->user_ig
            , 'user_wechat' => $request->user_wechat

            , 'img_user' => $request->img_user
            , 'user_email' => $request->user_email
            // , 'email_verified_at' =>""
            , 'user_type' => $user_type
            , 'password' => ""
            , 'remember_token' => $request->remember_token
            , 'created_at' => Carbon::now()
            , 'updated_at' => Carbon::now()
            , 'member_status' => "Y"
            , 'date_expiry' => $date_expiry
            , 'date_renew' => $request->date_renew
            , 'member_group' => $request->member_group
            , 'member_active' => "Y"
            , 'max_no' => $max_no
            , 'member_year' => $member_year
            , 'member_month' => $member_month
            , 'member_no' => $member_no
            // , 'img_certificate' => $img_certificate
            , 'member_www' => $request->member_www
            , 'date_register' => $date_register

        ]);

        $img_name = $this->uploadFile($request);

        if ($img_name != '') {
            $act = Members::where('member_uid', '=', $uid)->update([
                'img_profile' => $img_name,
            ]);

            if ($act) {
                $this->idcardimg($request,$uid);
            }

        }

        return redirect()->route('members.index');

    }

    public function edit(Request $request, $uid = '')
    {

        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $member = Members::where('member_uid', '=', $uid)->first();
        $country = Country::where('country_status', '=', 'Y')->orderBy('country_name')->get();
        $khans = Khans::where('khan_status', '=', 'Y')->orderBy('khan_index')->get();
        $krus = Members::where('user_type', '=', 'TEACHERS')->orderBy('full_name')->get();
        return view('admins.pages.members.edit', compact('country', 'khans', 'krus', 'member'));
    }

    public function update(Request $request)
    {

        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $fields = $request->validate(
            [

                'member_uid' => 'required',
                'first_name' => 'required',
                'gender' => 'required',
                'country_uid' => 'required',

            ],
            [
                'member_uid.required' => 'member id Is Required ',
                'first_name.required' => 'Name Is Required ',
                'gender.required' => 'Gender Is Required ',
                'country_uid.required' => 'Country Is Required ',
            ]
        );

        $uid = $request->member_uid != '' ? $request->member_uid : '';
        $_date = $request->date_register;
        $date_register = Carbon::parse($_date)->format('Y-m-d');
        $member_year = Carbon::parse($_date)->format('Y');
        $member_month = Carbon::parse($_date)->format('m');
        $khan_uid = $request->khan_uid;
        $khans = Khans::where('khan_uid', '=', $khan_uid)->first();
        $khan_no = 0;
        $khan_name = "";
        if ($khans) {
            $khan_no = $khans->khan_index;
            $khan_name = $khans->khan_name;
        }
        $country_uid = $request->country_uid;
        $country = Country::where('country_uid', '=', $country_uid)->first();

        $user_type = strtoupper($request->user_type);

        if ($user_type == 'MEMBERS') {
            $khan_no = 0;
            $khan_name = "";
            $khan_uid = "";
        }

        $kru_uid = $request->kru_uid;
        $kru = Members::where('member_uid', '=', $kru_uid)->first();
        $kru_name = "";
        if ($kru) {
            $kru_name = $kru->full_name;
        }

        $certificate_no = $request->certificate_no;

        if ($uid != '') {
            Members::where('member_uid', '=', $uid)->update([
                'first_name' => strtoupper($request->first_name)
                , 'last_name' => strtoupper($request->last_name)
                , 'full_name' => strtoupper($request->first_name . ' ' . $request->last_name)
                , 'gender' => $request->gender
                , 'dateofbirth' => $request->dateofbirth
                , 'user_tel' => $request->user_tel
                , 'khan_uid' => $khan_uid
                , 'khan_no' => $khan_no
                , 'khan_name' => $khan_name
                , 'certificate_no' => $certificate_no
                , 'kru_uid' => $kru_uid
                , 'under_kru' => $kru_name
                , 'club_uid' => $request->club_uid
                , 'club_name' => $request->club_name
                , 'user_address' => $request->user_address
                , 'country_uid' => $country_uid
                , 'country_code' => $country->country_code
                , 'country_name' => $country->country_name
                , 'user_facebook' => $request->user_facebook
                , 'user_ig' => $request->user_ig
                , 'user_wechat' => $request->user_wechat
                , 'img_user' => $request->img_user
                , 'user_email' => $request->user_email
                , 'user_type' => $user_type
                , 'updated_at' => Carbon::now()
                , 'member_status' => "Y"
                , 'member_group' => $request->member_group
                , 'member_www' => $request->member_www
                , 'date_register' => $date_register
                , 'member_year' => $member_year
                , 'member_month' => $member_month,
            ]);

            $img_name = $this->uploadFile($request);
            if ($img_name != '') {
                Members::where('member_uid', '=', $uid)->update([
                    'img_profile' => $img_name,
                ]);
            }
        }

        //$aboutus = Aboutus::orderBy('aboutus_index')->paginate($this->paging);
        return redirect()->route('members.index');
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

    public function uploadFile(Request $request)
    {
        $image = $request->file('fileupload');
        $imagename = '';

        $path = "/images/members";
        if ($image) {
            $imagename = time() . '.' . $image->extension();

            $filePath = public_path($path);

            if (!File::exists($filePath)) {

                File::makeDirectory($filePath, 0755, true, true);
            }

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(950, 600); //
            $image_resize->save($filePath . '/' . $imagename);

        }

        return $imagename;
    }

    public function delete(Request $request)
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $uid = $request->uid;

        $aboutus = Aboutus::where('aboutus_uid', '=', $uid)->first();

        $success = false;
        $message = 'fail';
        $response = [];
        if ($aboutus) {
            $success = true;

            $message = 'success';
            $success = Aboutus::where('aboutus_uid', '=', $uid)->delete();

        }

        return response()->json(['success' => $success, 'message' => $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

    public function getIdCard($no = 1, $prefix = '', $digit = 5)
    {
        $idcardno = "";
        $idcardno = str_pad($no, $digit, "0", STR_PAD_LEFT);
        $idcardno = $prefix . $idcardno;
        return $idcardno;
    }

    public function profileimg(Request $request)
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }
        // dd($request);
        $uid = $request->img_uid;

        $image = $request->file('fileupload');
        $imagename = '';

        $path = "/images/members";
        $imgSave = false;
        if ($image) {
            $imagename = time() . '.' . $image->extension();

            $filePath = public_path($path);

            if (!File::exists($filePath)) {

                File::makeDirectory($filePath, 0755, true, true);
            }

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(250, 450); //
            $image_resize->save($filePath . '/' . $imagename);

            $imgSave = true;

        }

        if ($imgSave) {
            Members::where('member_uid', '=', $uid)->update([
                'img_profile' => $imagename,
            ]);
        }
        $url = "/pageadmin/members/prosonal/edit/" . $uid;
        return redirect($url);
    }
    public function idcardimg(Request $request,$memberuid=null)
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $uid = isset($memberuid) ? $memberuid : $request->img_uid;
        $member = Members::where('member_uid', '=', $uid)->first();
        $sysinfo = Sysinfo::where('sys_uid', '!=', '')->first();

        $image = $request->file('fileupload');
        $imagename = '';

        $path = "/images/members/card";
        $imgSave = false;
        if ($image) {
            $imagename =  $member->member_no. '_' . time() . '.' . $image->extension();

            $filePath = public_path($path);

            if (!File::exists($filePath)) {

                File::makeDirectory($filePath, 0755, true, true);
            }

            $img_emp = Image::make($image->getRealPath());
            $img_emp->resize(250, 340);

            $img = Image::make(public_path('/images/main.png'));

            //top-left, top-right, bottom-left and bottom-right
            $img->insert($img_emp, 'top-left', 20, 20);

            $img->text($sysinfo->sys_name_th, 286, 50, function ($font) {

                $font->file(public_path('/assets/fonts/FC_Home.ttf'));
                $font->size(76);
                $font->color('#000099');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });

            $img->text($sysinfo->sys_name, 286, 120, function ($font) {
                $font->file(public_path('/assets/fonts/BoonTookMon-Regular.ttf'));
                $font->size(40);
                $font->color('#000099');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });

            $img->text('Name', 286, 180, function ($font) {
                $font->file(public_path('/assets/fonts/BOOKMADI.ttf'));
                $font->size(20);
                $font->color('#000099');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });

            $img->text($member->full_name, 286, 210, function ($font) {
                $font->file(public_path('/assets/fonts/BOOKMADI.ttf'));
                $font->size(20);
                $font->color('#000000');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });

            $img->text('Khan', 286, 270, function ($font) {
                $font->file(public_path('/assets/fonts/BOOKMADI.ttf'));
                $font->size(20);
                $font->color('#000099');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });

            $img->text($member->khan_name, 286, 300, function ($font) {
                $font->file(public_path('/assets/fonts/BOOKMADI.ttf'));
                $font->size(20);
                $font->color('#000000');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });

            $img->text('Country', 286, 370, function ($font) {
                $font->file(public_path('/assets/fonts/BOOKMADI.ttf'));
                $font->size(20);
                $font->color('#000099');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });

            $img->text($member->country_name, 290, 390, function ($font) {
                $font->file(public_path('/assets/fonts/BOOKMADI.ttf'));
                $font->size(20);
                $font->color('#000000');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });

            $img->text('Cer No.', 286, 430, function ($font) {
                $font->file(public_path('/assets/fonts/BOOKMADI.ttf'));
                $font->size(20);
                $font->color('#000099');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });

            $img->text($member->certificate_no, 290, 450, function ($font) {
                $font->file(public_path('/assets/fonts/BOOKMADI.ttf'));
                $font->size(20);
                $font->color('#000000');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });

            $img->text('Membership Valid Until', 140, 380, function ($font) {
                $font->file(public_path('/assets/fonts/BOOKMADI.ttf'));
                $font->size(20);
                $font->color('#b30000');
                $font->align('center');
                $font->valign('top');
                $font->angle(0);
            });

            $date_expiry = $member->date_expiry;

            $date_expiry = Carbon::parse($date_expiry)->format('d F Y'); // date("d F Y", $date_expiry);

            $img->text($date_expiry, 140, 430, function ($font) {
                $font->file(public_path('/assets/fonts/BoonTookMon-Regular.ttf'));
                $font->size(24);
                $font->color('#b30000');
                $font->align('center');
                $font->valign('top');
                $font->angle(0);
            });

            $img->text('Issue in Bangkok,Thailand', 15, 480, function ($font) {
                $font->file(public_path('/assets/fonts/BOOKMADI.ttf'));
                $font->size(18);
                $font->color('#000000');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });

            $img->text($sysinfo->sys_www, 340, 480, function ($font) {
                $font->file(public_path('/assets/fonts/BOOKMADI.ttf'));
                $font->size(20);
                $font->color('#000099');
                $font->align('left');
                $font->valign('top');
                $font->angle(0);
            });

            $img_barcode = Image::make(DNS1D::getBarcodePNG($member->member_no, 'C39', 2, 60, array(0, 0, 0), true));

            $img->insert($img_barcode, 'top-left', 250, 510);

            $img_qrcode = Image::make(DNS2D::getBarcodePNG($sysinfo->sys_www, 'QRCODE', 5, 5));

            $img->insert($img_qrcode, 'top-left', 750, 234);

            $img_logo = Image::make(public_path('/images/logo.png'));
            $img_logo->resize(200, 200);
            $img->insert($img_logo, 'top-left', 700, 370);

            $img->save(public_path('/images/members/card/' . $imagename));
            
            if ($imagename !='') {
                Members::where('member_uid', '=', $uid)->update([
                    'img_idcard' => $imagename,
                ]);
            }

        }

      
        $url = "/pageadmin/members/prosonal/edit/" . $uid;
        return redirect($url);

    }
}
