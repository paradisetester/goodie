<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

/*----- decode url -----*/
public function decodeID($id){
$id = base64_decode($id);
$id = explode('/', $id);
return $id[0];
}

/*----- encode url -----*/
public function encodeID($id){
$id = $id.'/'.time();
return base64_encode($id);
}

/*----- active user -----*/
public function auth($var){
return Auth::user()->$var;
}
public function adminPublicPath()
{
    return asset('/public/admin');
}
public function publicPath()
{
    return asset('/public');
}
/*----file Upload ----*/
public function fileupload($request){
$file = $request->file('image');
$destinationPath = publicbasePath().'/images/uploads/'.date('Y').'/'.date('M');
$filename = time().'_'.$file->getClientOriginalName();
$upload_success = $file->move($destinationPath, $filename);
$uploaded_file = 'images/uploads/'.date('Y').'/'.date('M').'/'.$filename;
return $uploaded_file;	
}
}
