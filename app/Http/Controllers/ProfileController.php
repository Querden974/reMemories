<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile(){
        if(!Auth::check()){
            return redirect()->intended(route('login'));
        }
        return view('profile');
    }
}
