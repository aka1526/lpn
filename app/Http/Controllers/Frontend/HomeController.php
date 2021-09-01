<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Cookie;
use File;
use DB;

use App\Models\Admins\Slidepage;


class HomeController extends Controller
{

    protected $paging = 10;
    protected $useruid = '';

    public function home()
    {
        $slidepage = Slidepage::where('slidepages_status', '=', 'Y')
        ->orderBy('slidepages_index')->paginate($this->paging);
        dd($slidepage);
         return view('frontend.pages.home',compact('slidepage'));
    }

   
}
