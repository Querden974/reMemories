<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserInfoPublic;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\EditProfileRequest;
use Illuminate\Support\Facades\Storage;

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

        return view('profile', compact('profile'));
    }

    public function editProfile(UserInfoPublic $info, EditProfileRequest $request){
        $data = $request->validated();
        // dd($data);


        if(!Auth::check()){
            return redirect()->intended(route('login'));
        }


        $user = $info->where('user_id', Auth::user()->id)->first();
        $existing = UserInfoPublic::where('user_id', Auth::user()->id)->first();
        if($existing && $user){

            $user->update($this->updateData($user, $request));
            return redirect()->route('profileShow', ['user' => auth()->user()->name])->with('success', 'Account updated successfully');
        } else {

           $info = UserInfoPublic::create($this->updateData(new UserInfoPublic, $request));

        return redirect()->route('profileShow', ['user' => auth()->user()->name])->with('success', 'Account added successfully');
        }
    }

    private function updateData(UserInfoPublic $user, EditProfileRequest $request): array{
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;

        /** @var UploadedFile|null $image */
        $image= $request->validated('profile_img');

        if($image === null || $image->getError()){
            return $data;
        }
        if($user->profile_img){
            Storage::disk('public')->delete($user->profile_img);
        }
        $data['profile_img'] = $image->store('profile_img','public');
        return $data;
    }
}
