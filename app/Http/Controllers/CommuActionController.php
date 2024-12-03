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
        if(!Auth::check()){
            return redirect('/login')->with('error', 'You must been logged to like a memory!');
        }
        $user = auth()->user();
        $memory = $request->post('id');
        $liked = $request->post('like');

        $currentMemory = PostMemories::where('id', $liked)->first();

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
        return redirect()->back();
    }

    public function comment(string $id){
        $memory = PostMemories::where('id', $id)->first();
        return view('components.comment-popup', compact('memory'));
    }

    public function commentSubmit(Request $request){

        if(!Auth::check()){
            return redirect('/login')->with('error', 'You must been logged to comment a memory!');
        }
        $currentMemory = PostMemories::where('id', $request->memory_id)->first();

        $data = $request->all();
        $data['author'] = Auth::user()->id;

        if(json_decode($currentMemory->comments, true) == null){
            $comments=[];
        } else {
            $comments = json_decode($currentMemory->comments, true);
        }

        $comment = array(
            'comment_id' => rand(time(),1),
            'comment' => $data['comment'],
            'author' => $data['author'],
            'created_at' => date('Y-m-d H:i:s'),
        );
        array_push($comments, $comment);


        $currentMemory->update(['comments' => json_encode($comments)]);
        //dd($comments);

        return redirect()->back();
    }
}
