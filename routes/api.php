<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register',[AuthController::class, 'registerUser']);
Route::post('/login',[AuthController::class, 'loginUser']);

//Requires user to be LOGGED IN FIRST BEFORE LOGGING OUT
Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout',[AuthController::class, 'logoutUser']);
});

Route::middleware('auth:sanctum')->group(function () {
    /* ROLES
    * 1 - Admin
    * 2 - Super Admin
    * 3 - Member
    * 4 - Encoder
    * 5 - Processor
    * 6 - Helpdesk
    */

    //SAMPLE ROUTE FOR ADMIN AND SUPER ADMIN
    Route::middleware('role_id:1,2')->group(function () {
        Route::get('/admin-dashboard', function (Request $request,Response $response) {
       
            try {
                return response()->json([
                    'message' => 'Welcom AdmiN!',
                ],200);
            } catch (\Exception $th) {
                return response()->json([
                    'message' => "ADMIN ACCESS ONLY!",
                ]);
            }
            
        });
    });

    //SAMPLE ROUTE FOR MEMBER
    Route::middleware('role_id:3')->group(function () {
        Route::get('/member-dashboard', function () {

           try {
                return response()->json([
                    'message' => 'Member Dashboard!',
                ],200);
            } catch (\Exception $th) {
                return response()->json([
                    'message' => "Login and use your member account",
                ]);
            }
        });
    });

    //SAMPLE ROUTE FOR ENCODER, PROCESSOR, AND HELP DESK
    Route::middleware('role_id:4,5,6')->group(function () {
        Route::get('/employee-dashboard', function () {
            try {
                return response()->json([
                    'message' => 'Employee Dashboard!!',
                ],200);
            } catch (\Exception $th) {
                return response()->json([
                    'message' => "Employee Access Only!",
                ]);
            }
        });
    });
});