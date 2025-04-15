<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('login');
});

Route::get('/admin', function () {
    return view('admin');
});
Route::get('/processor', function () {
    return view('processor');
});

Route::get('/signup',[AuthController::class,'showSignup'])->name('show.signup');
Route::get('/sign-in',[AuthController::class,'showSignin'])->name('show.signin');

Route::post('/signup',[AuthController::class,'signup'])->name('signup');
Route::post('/sign-in',[AuthController::class,'signin'])->name('signin');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');