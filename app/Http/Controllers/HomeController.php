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

        $memories = PostMemories::orderBy('created_at', 'desc')->paginate(10);
        return view('index', compact('memories'));
        //return view('index');
    }

    public function post(MemoryPostRequest $request){
        if(!Auth::check()){
            return redirect()->intended(route('login'));
        }
        $data = $request->all();


        $data['user_id'] = Auth::user()->id;
        if(isset($data['images'])){
           $images = $data['images'];
        foreach($images as $key => $image){
            $images[$key] = $image->store('images','public');
        }
        $data['images'] = json_encode($images);
        }



        //dd($data);
        PostMemories::create($data);
        return redirect()->intended(route('home'));
    }

    public function search(Request $request){
        $search = $request->search_bar;
        return redirect()->route('profileShow', ['user'=>$search]);
    }

    public function removePost(Request $request){
        session()->put('url.intended', url()->previous());
        $id = $request->id;
        $post = PostMemories::find($id);
        $post->delete();
        return redirect()->intended();
    }
}
