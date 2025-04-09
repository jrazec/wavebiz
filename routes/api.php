<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuditLogController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register',[AuthController::class, 'registerUser']);
Route::post('/login',[AuthController::class, 'loginUser']);
Route::post('/addRole',[AuthController::class, 'addRole']);

//Requires user to be LOGGED IN FIRST BEFORE LOGGING OUT
Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout',[AuthController::class, 'logoutUser']);
});



Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']); // all not deleted
    Route::post('/', [ProductController::class, 'store']); // create
    Route::put('/{id}', [ProductController::class, 'update']); // update
    Route::delete('/{id}', [ProductController::class, 'destroy']); // soft delete
});

Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/audit-logs', [AuditLogController::class, 'index']);