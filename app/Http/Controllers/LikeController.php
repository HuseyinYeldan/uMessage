<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request){
        //check if the user liked the current content if like make unlike if not make it like
        $user = Auth::user();
        $contentId = (int)$request->input('content_id');
        $isComment = (int)$request->input('isComment');
    
        $existingLike = Like::where('user_id', $user->id)
        ->where('content_id', $contentId)
        ->where('isComment', $isComment)
        ->first();

        if(!$existingLike){
            $data['user_id'] = Auth::user()->id;
            $data['content_id'] = (int)$request->input('content_id');
            $data['isComment'] = (int)$request->input('isComment');
            
            Like::create($data);
            return redirect()->back()->with('success',$isComment?'Comment liked':'Post Liked');
        }
            $existingLike->delete();
            return redirect()->back()->with('success',$isComment?'Comment unliked':'Post unliked');

    }
}
