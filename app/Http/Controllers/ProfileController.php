<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function search(User $user, Request $request){
        $posts = Post::where('user_id', $user->id);
        $searchTerm = $request->input('search');
        $posts = Post::search($searchTerm)->get();
        return view('auth.profiles.show', compact('user', 'posts'));
    }

    public function edit(){
        return view('auth.profiles.edit');
    }

    public function update(Request $request){
        $user = Auth::user();
        
        $data = [];
    
        // Check and update username if provided and different from the current username
        if ($request->has('username') && $request->username != $user->username) {
            $request->validate([
                'username' => 'alpha_dash|min:4|max:24|string|regex:/\w*$/|unique:users,username',
                'last_username_change' => 'date',
            ]);
            if(now()->diffInMonths($user->last_username_change) < 1 && $user->last_username_change != NULL){
                return redirect()->back()->with('error','You can change your username once a month.');
            }

            $data['last_username_change'] = Carbon::now()->toDateTimeString();
            $data['username'] = $request->username;
        }
    
        // Check and update avatar if provided
        if ($request->has('avatar')) {
            $request->validate([
                'avatar' => 'image|max:4096',
            ]);
            $data['avatar'] = $request->file('avatar')->store('avatars'); // Adjust the storage path accordingly
        }
    
        // Check and update password if both old password and new password are provided
        if ($request->filled('old_password') && $request->filled('password')) {
            $providedOldPassword = $request->old_password;
            $databasePassword = $user->password;
        
            // Debugging: Dump the values to check
            if (!Hash::check($providedOldPassword, $databasePassword)) {
                return redirect()->back()->with('error', 'Old password is incorrect.');
            }
            $data['password'] = $request->password;
        }
        
        
        // If any data is provided, update the user
        if (!empty($data)) {
            User::find($user->id)->update($data);
            return redirect("/feed")->with('success', 'Your profile has been updated.');
        }
    
        return redirect()->back()->with('error', 'Nothing changed.');
    }
       
}
