<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        if(Auth::check()){
            return redirect()->intended(route('home'));
        }

        return view('login');
    }


    public function doLogin(LoginRequest $request){
        $credentials = ['name' => $request->name, 'password' => $request->password];
        if(Auth::attempt($credentials)){
            //dd(Auth::attempt($credentials));
            $request->session()->regenerate();
            return redirect()->intended(route('home'))->with('success', 'You are now connected to your account!');
        };
        return redirect()->back()->withInput()->with('error', 'Invalid credentials');
    }

    public function doLogout(){
        session()->put('url.intended', url()->previous());
        Auth::logout();
        return redirect()->intended()->with('success', 'You are now disconnected from your account!');
    }
}
