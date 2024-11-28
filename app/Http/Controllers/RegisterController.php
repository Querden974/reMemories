<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function RegisterValitation(RegisterRequest $request)
    {
        // Si les règles de validation sont respectées, affiche les données validées
        //dd($request->validated());
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/login');
    }

    public function RegisterShow(){
        return view('register');
    }
}
