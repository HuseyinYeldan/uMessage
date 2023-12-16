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
    public function show(User $user){
        $userPost = $user->posts()->latest()->paginate(2);
        return view('auth.profiles.show', compact('user', 'userPost'));
    }
    
}
