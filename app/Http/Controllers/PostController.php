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
        $posts = Post::with('comments.recursiveReplies')->latest()->paginate(5);

        if ($request->ajax()) {
            return response()->json(['html' => view('auth._posts', compact('posts'))->render()]);
        }

        return view('auth.index', compact('posts'));
    }
    public function show(Request $request ,Post $post)
    {
        return view('auth.post.show', compact('post'));
    }
    public function edit(Request $request, Post $post){
        return view('auth.post.edit',compact('post'));
    }

    public function update(Request $request, Post $post){
        $post = Post::with('user')->find($request->post);
        if($post->user_id != Auth::user()->id){
            return redirect()->back()->with('error',"You don't have permission to do that.");
        }
        else{
            $data = $request->validate([
                'body' => 'required|max:500|min:1',
            ]);

            $post->update($data);
            
            return redirect("/m/$post->id")->with('success','Post has been updated.');
        }
    }
    public function destroy(Request $request,Post $post){
        $post = Post::with('user')->find($request->post);
        if($post->user_id != Auth::user()->id){
            return redirect()->back()->with('error',"You don't have permission to do that.");
        }
        Post::destroy($request->post);
        return redirect('/feed')->with('success','The post has been deleted.');
    }
}
