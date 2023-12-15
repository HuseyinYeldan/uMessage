<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function index(){
        return view('guest.sign-in');
    }

    public function store(Request $request){

        $credantials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(!Auth::attempt($credantials)){
            return redirect()->back()->withInput()->withErrors(['password' => 'Incorrect username or password.']);
        }
        Session::regenerate();

        return redirect('/feed')->with('success','You are logged in!');
    }

    public function destroy(){
        Auth::logout();
        Session::invalidate();
        
        return redirect('sign-in')->with('success','You are logged out!');
    }
}
