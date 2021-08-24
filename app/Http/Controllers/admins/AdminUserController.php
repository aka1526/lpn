<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

use Cookie;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Admins\User;
use App\Models\Admins\Accessuid;



class AdminUserController extends Controller
{
    protected  $paging = 10;

    public function NewUid()
    {
        $uuid = (string) Str::uuid();
        $uuid = str_replace("-", "", $uuid);
        return $uuid;
    }

    public function index()
    {

        $user = User::where('name','!=','')->orderBy('name')->paginate($this->paging);;

        return view('admins.pages.user_all', compact('user'));
    }

    public function register(Request $request)
    {

      
        $fields = $request->validate([

            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:6'
        ],
        [   
            'name.required'    => ' Username Is Required For Your Information ', 
            'email.required'      => 'E-mail Is Required For Your Information',
            'email.unique'      => 'Sorry, This Email Address Is Already Used By Another User',
            'password.required' => 'Password Is Required For Your Information Safety.',
            'password.min'      => 'assword Length Should Be More Than 6 Character',
        ]
    );

        
        $uid = $this->NewUid();
        $user = User::create([
            'uid' => $uid,
            'is_admin' => 'staff',
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $token = $this->NewUid();

        $action = User::where('uid', '=', $uid)->update([
            'uid_login' => $token
        ]);

        Accessuid::insert([
            'uid' => $this->NewUid(),
            'uid_login' =>  $token,
            'last_used_at' => Carbon::now()
        ]);

        $response = [
            'action' => $action,
            'msg' => 'success'
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'remon hasan'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function saveStorage(Request $request) {
        $postdata = $request->getContent();
        $myfile = time().str_random();
        Storage::disk('local')->put($myfile, $postdata);
      }

      
}
