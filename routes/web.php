<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('auth')->group(function(){
    Route::get('/feed', [PostController::class, 'index']);
    Route::get('/feed/{filter}', [PostController::class, 'index']);

    Route::get('/profiles',[ProfileController::class, 'index']);
    Route::get('/p/{user:username}',[ProfileController::class, 'show']);
    Route::get('/settings',[ProfileController::class, 'edit']);
    Route::post('/profile-update',[ProfileController::class, 'update'])->name('update.profile');

    Route::post('/logout', [SessionController::class, 'destroy']);

    Route::post('/share-post',[PostController::class, 'store'])->name('share.post');
    Route::delete('delete-post',[PostController::class, 'destroy'])->name('delete.post');
    Route::put('/update-post', [PostController::class, 'update'])->name('update.post');

    Route::post('/feed', [PostController::class, 'search'])->name('search.post');
    Route::post('/p/{user:username}',[ProfileController::class, 'search'])->name('search.user.post');
    
    Route::post('/comment', [CommentController::class, 'commentStore'])->name('post.comment');
    Route::post('/reply', [CommentController::class, 'replyStore'])->name('post.reply');
    Route::delete('delete-comment',[CommentController::class, 'destroy'])->name('delete.comment');

    Route::post('/like', [LikeController::class, 'store'])->name('like');

    Route::get('/m/{post}', [PostController::class, 'show']);
    Route::get('/m/edit/{post}', [PostController::class, 'edit']);

});

Route::middleware('guest')->group(function(){
    Route::get('/sign-up', [SignUpController::class, 'index'])->name('signUp');
    Route::post('/sign-up', [SignUpController::class, 'store']);
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/sign-in', [SessionController::class, 'index'])->name('login');
    Route::post('/sign-in', [SessionController::class, 'store']);
});

