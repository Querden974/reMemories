<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserInfoPublic;
use App\Models\User;

class ProfileController extends Controller
{
    public function profile(){
        if(!Auth::check()){
            return redirect()->intended(route('login'));
        }

        $info = UserInfoPublic::where('user_id', Auth::user()->id)->first();
        $user = Auth::user();
        $user->info = $info;
        dd($info);
        //return view('profile', compact('user'));
    }

    public function profileShow(string $name){
        $profile = User::with('userInfo')->where('name', $name)->firstOrFail();
        if(Auth::check()){
            $info = UserInfoPublic::where('user_id', Auth::user()->id)->first();
            $user = Auth::user();
            $user->info = $info;
            return view('profile', compact('profile', 'user'));
        }
        //dd(Auth::user());
        //dd($profile->id);
        return view('profile', compact('profile'));
    }

    public function editProfile(Request $request){
        if(!Auth::check()){
            return redirect()->intended(route('login'));
        }

        $existing = UserInfoPublic::where('user_id', Auth::user()->id)->first();
        if($existing){
            $existing->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'birthdate' => $request->birthdate,
                'profile_img' => $request->profileImg,
            ]);
            return redirect('login')->with('success', 'Account updated successfully');
        } else {
           $info = UserInfoPublic::create([
            'user_id' => Auth::user()->id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'birthdate' => $request->birthdate,
            'profile_img' => $request->profileImg,

        ]);

        return redirect('login')->with('success', 'Account added successfully');
        }



    }
}
