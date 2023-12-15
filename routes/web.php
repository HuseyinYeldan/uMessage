<?php

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
    Route::get('/feed', [SessionController::class, 'show']);
    Route::post('/logout', [SessionController::class, 'destroy']);
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

