<?php

namespace App\Http\Controllers;

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
        $data['likes'] = null;

        Post::create($data);

        return redirect()->back()->with('success','Your message is sent to the world.');
    }
    public function index(Request $request)
    {
        $posts = Post::latest()->paginate(10);
    
        if ($request->ajax()) {
            return response()->json(['html' => view('auth._posts', compact('posts'))->render()]);
        }
    
        return view('auth.index', compact('posts'));
    }
    


}
