<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Cookie;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
class AdminHomeController extends Controller
{
    public function admin(){
        
        return view('admins.pages.home');
    }

     

}
