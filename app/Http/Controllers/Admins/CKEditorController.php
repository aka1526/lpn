<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Image;

class CKEditorController extends Controller
{
    public function upload(Request $request)
    {
       
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $filePath = public_path('/images/ckeditor');
            if (!File::exists($filePath)) {

                File::makeDirectory($filePath, 0755, true, true);
            }

            $request->file('upload')->move( $filePath, $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url =  '/images/ckeditor/'.$fileName; 
            $msg = 'Image successfully uploaded'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }
}
