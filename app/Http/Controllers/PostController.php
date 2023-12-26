<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'body' => 'required|max:500|min:1',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size limit as needed
        ]);
    
        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('posts');
        }
    
        $data['user_id'] = Auth::user()->id;
    
        Post::create($data);
    
        $newPost = Post::with('user')->where('user_id', Auth::user()->id)->latest()->first();
    
        // Render the new post view
        $newPostHtml = View::make('auth.partials._single_post', ['post' => $newPost])->render();
    
        // Return response
        return response()->json(['html' => $newPostHtml]);
    }
    
    public function index(Request $request, $filter = null)
    {
        $query = Post::with([
            'user',
            'comments.user',
            'comments.likes',
            'comments.replies.user',
            'comments.replies.likes',
            'comments.replies.recursiveReplies.user',
            'comments.replies.recursiveReplies.likes',
            'likes.post',
            'likes.comment.user',
            'likes.comment.replies.user',
            'likes.comment.replies.likes',
        ]);
    
        switch ($filter) {
            case 'popular':
                $posts = $query
                    ->withCount('likes')
                    ->orderByDesc('likes_count')
                    ->latest()
                    ->paginate(10);
                break;
            case 'newest':
                $posts = $query->latest()->paginate(10);
                break;
            case 'oldest':
                $posts = $query->oldest()->paginate(10);
                break;
            case 'controversial':
                $posts = $query->withCount('comments')->orderByDesc('comments_count')->paginate(10);
                break;
            default:
                $posts = $query->latest()->paginate(10);
                break;
        }
    
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
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            // Check if a new image is uploaded
            if ($request->file('image')) {
                // Delete the old image file
                if ($post->image) {
                    Storage::delete($post->image);
                }
                // Store the new image file
                $data['image'] = $request->file('image')->store('posts');
            }
    
            // Update the post with the new data
            $post->update($data);
    
            return redirect("/m/$post->id")->with('success', 'Post has been updated.');
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

    public function search(Request $request){
        
        $request->validate([
            'search'=> 'max:64|string',
        ]);

        $searchTerm = $request->input('search');
        $posts = Post::search($searchTerm)->get();
        return view('auth.index', compact('posts', 'searchTerm'));
    }
}
