<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadImage extends Controller
{
    
    public function upload(Request $req) 
    { 
        $getanhbia = '';
        if($req->hasFile('uploaded_file')){
        
            //Lưu hình ảnh vào thư mục public/images
            $anhbia = $req->file('uploaded_file');
            $getanhbia = time().'_'.$anhbia->getClientOriginalName();
            $destinationPath = public_path('images');
            $anhbia->move($destinationPath, $getanhbia);
            echo $getanhbia;
        }
    } 

}
