<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostMemories;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CommuActionController extends Controller
{
    public function likePost(Request $request)
    {

        $user = auth()->user();
        $memory = $request->post('id');
        $liked = $request->post('like');

        $currentMemory = PostMemories::where('id', $liked)->first();

        //array_push($likedBy, 167);

        if($currentMemory->liked_by == null){
            $likedBy=[];
        } else {
            $likedBy = json_decode($currentMemory->liked_by, true);
        }


        if(in_array($user->id, $likedBy)){
            foreach ($likedBy as $key => $value) {
                if ($value === $user->id) {
                    unset($likedBy[$key]);
                }
            }
        }else{
            array_push($likedBy, $user->id);
        }

        $currentMemory->update(['liked_by' => $likedBy]);

        //dd($likedBy);





        //dd($likes);




        return redirect()->back();
    }
}
