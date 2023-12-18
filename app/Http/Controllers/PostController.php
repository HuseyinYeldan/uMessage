<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'body' => 'required|max:500|min:1',
        ]);

        $data['user_id'] = Auth::user()->id;

        Post::create($data);

        return redirect()->back()->with('success','Your message is sent to the world.');
    }
    public function index(Request $request)
    {
        $posts = Post::paginate(10);
        $comments = Comment::with('replies')->whereNull('parent_id')->get();

        if ($request->ajax()) {
            return response()->json(['html' => view('auth._posts', compact('posts','comments'))->render()]);
        }
    
        return view('auth.index', compact('posts','comments'));
    }
}
