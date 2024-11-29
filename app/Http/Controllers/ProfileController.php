<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserInfoPublic;

class ProfileController extends Controller
{
    public function profile(){
        if(!Auth::check()){
            return redirect()->intended(route('login'));
        }

        $info = UserInfoPublic::where('user_id', Auth::user()->id)->first();
        $user = Auth::user();
        $user->info = $info;
        //dd($info);
        return view('profile', compact('user'));
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
