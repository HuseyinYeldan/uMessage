<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

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
        $post = Post::where('id',(int)$request->input('post'))->first();

        $newComment = Comment::with('post')->where('user_id',Auth::user()->id)->latest()->first();

        $newCommentHTML = View::make('auth.partials.comment',['comment'=>$newComment,'post'=>$post])->render();

        return response()->json(['html'=>$newCommentHTML]);

        // return redirect()->back()->with('success','Your comment has been published.');
    }
    public function destroy(Request $request){
        $comment = Comment::with('user')->find($request->comment);
        if($comment->user_id != Auth::user()->id){
            return redirect()->back()->with('error',"You don't have permission to do that.");
        }
        Comment::destroy($request->comment);
        return redirect()->back()->with('success','The comment has been deleted.');
    }
}
