<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignUpController extends Controller
{
    public function index(){
        return view('guest.sign-up');
    }
    
    public function store(Request $request){
        $attributes = $request->validate([
            'username' => 'required|min:4|max:24|string|regex:/\w*$/|unique:users,username',
            'avatar' => 'image|max:4096',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|min:8|max:64',
            'password_confirmation' => 'required|min:8|max:64',
        ]);

        $attributes['avatar'] = $request->file('avatar')->store('avatar');

        $user = User::create($attributes);
        Auth::login($user);
        
        return redirect('/feed')->with('success','You are registered.');
    }
}
