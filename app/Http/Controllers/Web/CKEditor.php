<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class CKEditor extends Controller
{
     public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $user = Auth::user();
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(storage_path('app/public/images/upload/' . $user->user_id . "/"), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/images/upload/' . $user->user_id . "/".$fileName); 
            $msg = 'Tải lên thành công'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            return $response;
        }
    }
}
