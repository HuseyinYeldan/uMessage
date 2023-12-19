<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function replyStore(Request $request)
    {
        $data = $request->validate([
            'content' => 'required|max:500|min:1'
        ]);
        $data['user_id'] = Auth::user()->id;
        $data['parent_id'] = (int)$request->input('comment');;
        $data['post_id'] = (int)$request->input('post');

        Comment::create($data);
        return redirect()->back()->with('success','Your reply has been published.');
    }
    public function commentStore(Request $request)
    {
        $data = $request->validate([
            'content' => 'required|max:500|min:1'
        ]);
        $data['user_id'] = Auth::user()->id;
        $data['parent_id'] = NULL;
        $data['post_id'] = (int)$request->input('post');

        Comment::create($data);
        return redirect()->back()->with('success','Your comment has been published.');
    }
}
