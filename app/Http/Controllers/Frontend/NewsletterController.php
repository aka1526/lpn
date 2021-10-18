<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admins\Newsletters;
use Carbon\Carbon;
use Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsletterController extends Controller
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

    public function subscribe(Request $request)
    {
        // dd($request->ip());
        $email = $request->email;

        $fields = $request->validate(
            [

                'email' => 'required',

            ],
            [
                'email.required' => 'E-mail Is Required ',

            ]
        );

        if ($email == '') {
            return redirect()->back();
        }

        $ipaddress = $request->ip();
        $news_by_os = $request->header('User-Agent');
        // dd($news_by_os);
        $created_by = $this->username != '' ? $this->username : 'guest';
        $useruid = $this->useruid != '' ? $this->useruid : '-';
        $news_uid = $this->NewUid();
        $action = Newsletters::insert([
            'news_uid' => $news_uid
            , 'news_type' => 'subscribe' // subscribe ,contact
            , 'news_subject' => 'subscribe'
            , 'news_email' => $email
            , 'news_name' => '-'
            , 'news_phone' => '-'
            , 'news_date' => Carbon::now()
            , 'news_message' => 'subscribe'
            , 'news_message_reply' => '-'
            , 'news_ref_uid' => $news_uid
            , 'news_by_ipaddress' => $ipaddress
            , 'news_by_os' => $news_by_os
            , 'news_member_id' => $useruid
            , 'news_status' => 'Y'
            , 'msg_inout' => 'IN'
            , 'created_by' => $created_by
            , 'updated_by' => $created_by
            , 'created_at' => Carbon::now()
            , 'updated_at' => Carbon::now(),
        ]);
        return redirect()->back()->with('message', 'Thank You For Subscribing!');
    }

    public function contact(Request $request)
    {
        //  dd( $request);

        $fields = $request->validate(
            [

                'email' => 'required|string',
                'subject' => 'required',
                'message' => 'required',

            ],
            [
                'email.required' => 'E-mail Is Required ',
                'subject.required' => 'subject Is Required ',
                'message.required' => 'Message Is Required ',
            ]
        );

        $email = $request->email;
        $ipaddress = $request->ip();
        $news_by_os = $request->header('User-Agent');
        // dd($news_by_os);
        $created_by = $this->username != '' ? $this->username : 'guest';
        $useruid = $this->useruid != '' ? $this->useruid : '-';
        $news_uid = $this->NewUid();

        $action = Newsletters::insert([
            'news_uid' => $news_uid
            , 'news_type' => 'contact' // subscribe ,contact
            , 'news_subject' => $request->subject
            , 'news_email' => $email
            , 'news_name' => $request->name
            , 'news_phone' => $request->phone
            , 'news_date' => Carbon::now()
            , 'news_message' => $request->message
            , 'news_message_reply' => '-'
            , 'news_ref_uid' => $news_uid
            , 'news_by_ipaddress' => $ipaddress
            , 'news_by_os' => $news_by_os
            , 'news_member_id' => $useruid
            , 'news_status' => 'Y'
            , 'msg_inout' => 'IN'
            , 'created_by' => $created_by
            , 'updated_by' => $created_by
            , 'created_at' => Carbon::now()
            , 'updated_at' => Carbon::now(),
        ]);
        return redirect()->back()->with('message', 'Thank you Messages!');
    }

    public function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }
}
