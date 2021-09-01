<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cookie;

class UserController extends Controller
{
  public function index(){
    Cookie::queue('DONO',"99999999999", 60);
    return view('user');
    
  }
}
