<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        $users = User::latest()->paginate(10);

        return view('auth.profiles.index', compact('users'));
    }
    public function show(User $user, Request $request){
        $posts = $user->posts()->latest()->paginate(10);
        if($request->ajax()){
            return response()->json(['html'=> view('auth._posts',compact('user','posts'))->render()]);
        }
        return view('auth.profiles.show', compact('user', 'posts'));
    }
    
}
