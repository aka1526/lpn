<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cookie;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Admins\User;
use App\Models\Admins\Accessuid;
use App\Models\Admins\Pageheader;

use Image;
use File;

use App\Models\Admins\News;
use App\Models\Admins\NewsCatalog;

class NewsController extends Controller
{
    protected  $paging = 5;
    protected  $useruid = '';
    protected $username = '';
    
    public function GetUserUid(){
   
        $loginuid =  Cookie::get('loginuid') !=''  ?  Cookie::get('loginuid') : '';
        $useruid=''; 
        $Accessuid=0;
        $Accessuid = Accessuid::where('uid_login', '=',$loginuid)->count();
        if($Accessuid>0){
            $user = User::where('uid_login', '=',$loginuid)
            ->where('user_status','=','Y')->first();
            
        } else {
            Cookie::queue(Cookie::forget('loginuid'));
            
        }
      
        $useruid = isset($user->uid) ? $user->uid :'';
        $this->username = isset($user->uid) ? $user->name : '';
        
         return $useruid ;
        }

    public function NewUid()
    {
        $uuid = (string) Str::uuid();
        $uuid = str_replace("-", "", $uuid);
        return $uuid;
    }
 
    public function home(Request $request)
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
   
        $news = Pageheader::where('pageheader_type', '=', 'news')->first();
          
        return view('admins.pages.news.home', compact('news'));
    }

    public function header(Request $request)
    {
       
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
   
          $fields = $request->validate(
            [

                'pageheader_title' => 'required|string',
                'pageheader_header' => 'required|string',
                'pageheader_detail' => 'required|string',
               
            ],
            [
                'pageheader_title.required' => 'Title Is Required ',
                'pageheader_header.required' => 'Header Is Required ',
                'pageheader_detail.required' => 'Detail Is Required ',
                

            ]
        );


        $pageheader_type='news';

        $pageheader =Pageheader::where('pageheader_type','=',$pageheader_type)->first();
       
        $success = false;
        $message = 'fail';
        $response = [];
        
        if($pageheader){

            $action =  Pageheader::where('pageheader_uid','=',$request->pageheader_uid)->update([
                'pageheader_title' =>$request->pageheader_title, 
                'pageheader_header'=>$request->pageheader_header, 
                 'pageheader_detail'=>$request->pageheader_detail

            ]);

        } else {

            $pageheader_uid = $this->NewUid();
            $action = Pageheader::insert([
                'pageheader_uid' => $pageheader_uid ,
                'pageheader_type' => $pageheader_type,
                'pageheader_title' =>$request->pageheader_title, 
                'pageheader_header'=>$request->pageheader_header, 
                 'pageheader_detail'=>$request->pageheader_detail,
                 'pageheader_status' => 'Y',

            ]);

        }
        
        $news =Pageheader::where('pageheader_type','=',$pageheader_type)->first();   
       
        return view('admins.pages.news.home', compact('news'));  
        
        //return response()->json(['success' => $success, 'message' => $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

    public function index(Request $request)
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

        $news = News::where('news_status', '!=', '')
        ->orderBy('news_index','desc')->paginate($this->paging);
        
        return view('admins.pages.news.index', compact('news'));  
    }

    public function new(Request $request)
    {
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }

       $NewsCatalog= NewsCatalog::where('catalog_status','Y')->orderBy('catalog_index')->get();

        return view('admins.pages.news.add',compact('NewsCatalog'));  
    }

    public function add(Request $request)
    {
        
        if ($this->GetUserUid() == '') {
            return redirect(url('/pageadmin/adminlogin'));
        }
       // dd($request);
        $fields = $request->validate(
            [

                'news_toppic' => 'required|string|unique:news,news_toppic',
                
               
            ],
            [
                'news_toppic.required' => 'Toppic Name Is Required ',
                'news_toppic.unique' => 'Toppic Name Is Duplicate ',
                  ]
        );

        $uid =   $this->NewUid();

       
        $url= $request->news_url !='' ? $request->news_url  :  str_replace(' ', '-', $request->news_toppic)  ;
        $url= strtolower($url);
        $url=str_replace('.', '', $url);
        $news_index= News::max('news_index')+1;   
        $action = News::insert([
            'news_uid'=> $uid,
            'news_index' => $news_index,
            'news_group' => $request->news_group,
            'news_toppic' =>$request->news_toppic,
            'news_desc' =>$request->news_desc,
            'news_url'  => $url ,
            'news_status' =>"Y",
            'news_icon' =>"",
            'news_datetime' =>Carbon::parse($request->news_datetime)->format('Y-m-d H:i')  ,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
          

        ]);
        $new_img = $this->uploadFile($request, $url ) ;

        if ($new_img !='') {
            News::where('news_uid','=',$uid)->update([
                'news_img'=> $new_img
            ]);
           
        }
         
      return redirect()->route('news.index') ;  
    }

    public function edit(Request $request,$uid='')
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
   
          if($uid!='') {
            $news = News::where('news_uid', '=',$uid)->first();
          }
       
          $NewsCatalog= NewsCatalog::where('catalog_status','Y')->orderBy('catalog_index')->get();
        return view('admins.pages.news.edit', compact('news','NewsCatalog'));
    }

    public function update(Request $request )
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }

          $uid = $request->news_uid;
          $url= $request->news_url !='' ? $request->news_url  :  str_replace(' ', '-', $request->news_toppic)  ;
          $url= strtolower($url);
          $url=str_replace('.', '', $url);
          if($uid!='') {
            $action = News::where('news_uid','=',$uid)->update([
                'news_toppic' =>$request->news_toppic,
                'news_group' =>$request->news_group,
                'news_desc' =>$request->news_desc,
                'news_url'  => $url ,
                'news_datetime' =>Carbon::parse($request->news_datetime)->format('Y-m-d H:i')  ,
                'updated_at' => Carbon::now(),
            ]);
            $new_img = $this->uploadFile($request, $url ) ;
    
            if ($new_img !='') {
                News::where('news_uid','=',$uid)->update([
                    'news_img'=> $new_img
                ]);
               
            }
          }
       
          
          return redirect()->route('news.index') ;  
    }
     

    public function delete(Request $request )
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
          
          $uid = $request->uid;
          $action=false;
          $message="fail";
          
          if($uid!='') {
            $action = News::where('news_uid','=',$uid)->delete();
            $message="success";
            
          }
       
          return response()->json(['success' => $action, 'message' => $message  ], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
          //return redirect()->route('news.index') ;  
    }
     

    public function updatestatus(Request $request)
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
         
        $uid =  $request->uid;
        
        $course = News::where('news_uid', '=', $uid)->first();
        $course_total= 0;
        $success = false;
        $message = 'fail';
        $response = [];
        if ($course) {
            $success = true;
             $message = 'success';
              
            $success =  News::where('news_uid', '=', $uid)->update([
                "news_status" =>  $request->status,
            ]);
            $response = [
                "success" =>  $success,
            ];
           
        }
        
        return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }


    
    public function catalog(Request $request,$uid='')
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
        $catalog = NewsCatalog::orderBy('catalog_index','desc')->paginate($this->paging);
              
        return view('admins.pages.news.catalog', compact('catalog'));
    }

    public function catalogNew(Request $request )
    {
        if( $this->GetUserUid()==''){
            return  redirect(url('/pageadmin/adminlogin'))  ; 
          }
      //  $catalog = NewsCatalog::orderBy('catalog_index','desc')->paginate($this->paging);
         $html='
         <form class="form-horizontal" id="frm" name="frm" method="post" 
         action="/pageadmin/news/catalog/add">
         <input type="hidden" name="_token" value="'.csrf_token().'">							 
         <div class="form-group">
             <label for="catalog_index">Catalog No</label>
             <input type="number" class="form-control" id="catalog_index" name="catalog_index" min="1" value="1" placeholder="No">
         </div>

         <div class="form-group">
             <label for="catalog_name">Catalog Name</label>
             <input type="text" class="form-control" id="catalog_name" name="catalog_name" placeholder="catalog name" required>
         </div>
      
         <div class="form-group mb-0 mt-3 justify-content-end">
             <div>
             <button aria-label="Close" class="btn ripple btn-close btn-danger pd-x-25" data-dismiss="modal" type="button">Close</button>
                 <button type="submit" class="btn btn-primary">Save</button>
                
             </div>
         </div>
     </form>';

     $success = false;
     $message = 'fail';
     $response = [];
     if ($html !='') {
         $success = true;
          $message = 'success';
           
        //  $success =  News::where('news_uid', '=', $uid)->update([
        //      "news_status" =>  $request->status,
        //  ]);
         $response = [
             "success" =>  $html,
         ];
        
     }
     
     return response()->json(['success' => $success, 'message' =>  $message, 'data' => $html], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
 }

 public function catalogAdd(Request $request)
 {
    // dd( $request);
     
     if ($this->GetUserUid() == '') {
         return redirect(url('/pageadmin/adminlogin'));
     }

     $fields = $request->validate(
         [

             'catalog_name' => 'required|string|unique:news_catalog,catalog_name',
             
            
         ],
         [
             'catalog_name.required' => 'Catalog Name Is Required ',
             'catalog_name.unique' => 'Catalog Name Is Duplicate ',
               ]
     );

     $uid =   $this->NewUid();

    $created_by= $this->username;
      
     $news_index= NewsCatalog::max('catalog_index')+1;   
     $action = NewsCatalog::insert([
         'catalog_uid'=> $uid,
         'catalog_index' => $news_index,
         'catalog_name' => $request->catalog_name ,
         'catalog_status' =>"Y",
         'created_by'  => $created_by,
         'updated_by' =>$created_by ,
         'created_at' => Carbon::now(),
         'updated_at' => Carbon::now(),
       

     ]);
     
      
   return redirect()->route('news.catalog') ;  
 } 
 
 public function catalogDelete(Request $request)
 {
     if( $this->GetUserUid()==''){
         return  redirect(url('/pageadmin/adminlogin'))  ; 
       }
      
     $uid =  $request->uid;
     
     $course = NewsCatalog::where('catalog_uid', '=', $uid)->first();
     $course_total= 0;
     $success = false;
     $message = 'fail';
     $response = [];
     if ($course) {
         $success = true;
          $message = 'success';
         $success =  NewsCatalog::where('catalog_uid', '=', $uid)->delete();
         $response = [
             "success" =>  $success,
         ];
        
     }
     
     return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
 }

 
 public function catalogStatus(Request $request)
 {
     if( $this->GetUserUid()==''){
         return  redirect(url('/pageadmin/adminlogin'))  ; 
       }
      
     $uid =  $request->uid;
     $status =  $request->status;
     $course = NewsCatalog::where('catalog_uid', '=', $uid)->first();
     $course_total= 0;
     $success = false;
     $message = 'fail';
     $response = [];
     if ($course) {
         $success = true;
          $message = 'success';
         $success =  NewsCatalog::where('catalog_uid', '=', $uid)->update([
             "catalog_status"=> $status
         ]);
         $response = [
             "success" =>  $success,
         ];
        
     }
     
     return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
 }

 
 
 public function catalogEdit(Request $request )
 {
     if( $this->GetUserUid()==''){
         return  redirect(url('/pageadmin/adminlogin'))  ; 
       }
       $uid = $request->uid;
       $catalog = NewsCatalog::where('catalog_uid',$uid)->first();
       
       $html="";
       if($catalog ){
        $html .='
        <form class="form-horizontal" id="frm" name="frm" method="post" 
        action="/pageadmin/news/catalog/updates">
        <input type="hidden" name="_token" value="'.csrf_token().'">	
        <input type="hidden" name="uid" value="'.$uid.'">						 
        <div class="form-group">
            <label for="catalog_index">Catalog No</label>
            <input type="number" class="form-control" id="catalog_index" name="catalog_index" min="1" value="'.$catalog->catalog_index.'" placeholder="No">
        </div>
  
        <div class="form-group">
            <label for="catalog_name">Catalog Name</label>
            <input type="text" class="form-control" id="catalog_name" name="catalog_name" placeholder="catalog name" value="'.$catalog->catalog_name.'" required>
        </div>
     
        <div class="form-group mb-0 mt-3 justify-content-end">
            <div>
            <button aria-label="Close" class="btn ripple btn-close btn-danger pd-x-25" data-dismiss="modal" type="button">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
               
            </div>
        </div>
    </form>';
     
       }
     
  $success = false;
  $message = 'fail';
  $response = [];
  if ($html !='') {
      $success = true;
       $message = 'success';
        
     //  $success =  News::where('news_uid', '=', $uid)->update([
     //      "news_status" =>  $request->status,
     //  ]);
      $response = [
          "success" =>  $html,
      ];
     
  }
  
  return response()->json(['success' => $success, 'message' =>  $message, 'data' => $html], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
}


public function catalogUpdate(Request $request)
{
    if( $this->GetUserUid()==''){
        return  redirect(url('/pageadmin/adminlogin'))  ; 
      }
     
    $uid =  $request->uid;
     
    $NewsCatalog = NewsCatalog::where('catalog_uid', '=', $uid)->first();
    $catalog_name =$request->catalog_name;
    $catalog_index =$request->catalog_index;
     
    $success = false;
    $message = 'fail';
    $response = [];
    if ($NewsCatalog) {
        $success = true;
         $message = 'success';
        $success =  NewsCatalog::where('catalog_uid', '=', $uid)->update([
            "catalog_name"=> $catalog_name
            ,"catalog_index"=> $catalog_index
        ]);
        $response = [
            "success" =>  $success,
        ];
       
    }
    return redirect()->route('news.catalog') ; 
   // return response()->json(['success' => $success, 'message' =>  $message, 'data' => $response], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
}


    public function uploadFile(Request $request,$url='')
    {
        $image = $request->file('fileupload');
       
        $imagename = '';
        if ($image) {
            $imagename = time() . '.' . $image->extension();

            $filePath = public_path('/images/news/'.$url);
            $filePath_thumbnails = public_path('/images/news/'.$url.'/thumbnails');
            if (!File::exists($filePath_thumbnails)) {

                File::makeDirectory($filePath_thumbnails, 0755, true, true);
            }

            $image_thumbnail = Image::make($image->getRealPath());
            $image_thumbnail->resize(370, 230); //
            $image_thumbnail->save($filePath_thumbnails . '/' . $imagename);
            
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(868, 480); //
            $image_resize->save($filePath . '/' . $imagename);
            
        }

        return $imagename;
    }
}
