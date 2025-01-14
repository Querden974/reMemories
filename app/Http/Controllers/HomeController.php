<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MemoryPostRequest;
use App\Models\PostMemories;
use App\Models\User;
use App\Models\UserInfoPublic;

class HomeController extends Controller
{
    public function index(){

        //dd($memories);
        return view('index');
    }

    public function post(MemoryPostRequest $request){
        if(!Auth::check()){
            return redirect()->intended(route('login'));
        }
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        PostMemories::create($data);
        return redirect()->intended(route('home'));
    }

    public function search(Request $request){
        $search = $request->search_bar;
        //dd($search);
        return redirect()->route('profileShow', ['user'=>$search]);
    }


}
