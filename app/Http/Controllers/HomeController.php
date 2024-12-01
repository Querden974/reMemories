<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class HomeController extends Controller
{
    public function index(){
        return view('index');
    }

    public function post(Request $request){
        $files = $request;
        // foreach($files as $file){
        //     $file->store('public/images');
        // }
        dd($files);
    }
}
