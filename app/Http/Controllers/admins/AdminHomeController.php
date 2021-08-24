<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminHomeController extends Controller
{
    public function admin(){
        return view('admins.pages.home');
    }

     

}
