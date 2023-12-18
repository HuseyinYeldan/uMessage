<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
            'parent_id' => $request->input('parent_id'),
        ]);

        return back();
    }

}
