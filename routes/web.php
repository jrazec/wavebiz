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
Route::get('/member', function () {
    return view('member');
});

