<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Admins\AdminUserController;
use App\Http\Controllers\Controller;
use App\Models\Admins\Adminmenus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminmenuController extends Controller
{
    protected $paging = 10;
    protected $adminUser;

    public function __construct(AdminUserController $adminUser)
    {
        $this->adminUser = $adminUser;
    }

    public function NewUid()
    {
        $uuid = (string) Str::uuid();
        $uuid = str_replace("-", "", $uuid);
        return $uuid;
    }
 
    public function index()
    {

        //  dd($this->adminUser->GetUserUid());
        if ($this->adminUser->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $mainmenu = Adminmenus::where('menu_status', '!=', '')
            ->orderBy('menu_index')->paginate($this->paging);

        return view('admins.pages.menu_all', compact('mainmenu'));
    }

  
    public function create()
    {
        dd('create');
    }

  
    public function store(Request $request)
    {

        if ($this->adminUser->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $fields = $request->validate(
            [

                'menu_name' => 'required|string|unique:admin_menus,menu_name',
                'menu_url' => 'required|string',
                'menu_route' => 'required|string',
            ],
            [
                'menu_name.required' => 'Menu Name Is Required ',
                'menu_name.unique' => 'Menu Name Is Duplicate ',
                'menu_url.required' => 'Menu Url Is Required ',
                'menu_route.required' => 'Menu Route Is Required ',

            ]
        );
        $success = false;
        $message = 'fail';
        $response = [];

        $uid = $this->adminUser->NewUid();
        $action = Adminmenus::create([
            'menu_uid' => $uid,
            'menu_name' => $request->menu_name,
            'menu_name_th' => $request->menu_name_th,
            'menu_url' => $request->menu_url,
            'menu_route' => $request->menu_route,
            'menu_index' => $request->menu_index,
            'menu_icon' => $request->menu_icon,
            'menu_class' => $request->menu_class,
            'menu_status' => $request->menu_status,
            'menu_main' => $request->menu_status,
            'menu_main_name' => $request->menu_main_name,
            'created_at' => Carbon::now(),

        ]);
        if ($action) {
            $success = $action;
            $message = 'success';
            $response = [];
        }
        return response()->json(['success' => $success, 'message' => $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

  
    public function show(Adminmenus $adminmenus)
    {
        // dd('show');
    }

    
    public function get(Request $request)
    {

        if ($this->adminUser->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $menu_uid = $request->uid;
        $menu = Adminmenus::where('menu_status', '=', 'Y')
            ->where('menu_uid', '=', $menu_uid)
            ->orderBy('menu_index')->first();
        $success = false;
        $message = 'fail';
        $response = [];
        if ($menu) {
            $success = true;
            $message = 'success';
            $response = $menu;

        }
        return response()->json(['success' => $success, 'message' => $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }
  
    public function update(Request $request)
    {

        if ($this->adminUser->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $fields = $request->validate(
            [

                'menu_name' => 'required|string|unique:admin_menus,menu_name',
                'menu_url' => 'required',
                'menu_route' => 'required',
                'menu_status' => 'required',

            ],
            [
                'menu_name.required' => 'Menu Name Is Required ',
                'menu_name.unique' => 'Menu Name Is Duplicate ',
                'menu_url.required' => 'Menu Url Is Required ',
                'menu_route.required' => 'Menu Route Is Required ',
                'menu_status.required' => 'Menu Status Is Required ',

            ]
        );

        $menu_uid = $request->menu_uid;
        $menu = Adminmenus::where('menu_uid', '=', $menu_uid)->first();
        $success = false;
        $message = 'fail';
        $response = [];
        if ($menu) {
            //   dd( $request->menu_name);
            $action = Adminmenus::where('menu_uid', '=', $menu_uid)->update([
                'menu_name' => $request->menu_name
                , 'menu_name_th' => $request->menu_name_th
                , 'menu_route' => $request->menu_route
                , 'menu_icon' => $request->menu_icon
                , 'menu_class' => $request->menu_class
                , 'menu_url' => $request->menu_url
                , 'menu_index' => $request->menu_index
                , 'menu_status' => $request->menu_status,
            ]);

            if ($action) {
                $success = true;
                $message = 'success';
                $response = $menu;
            }

        }
        return response()->json(['success' => $success, 'message' => $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

 
    public function destroy(adminmenus $adminmenus)
    {
        //
    }
}
