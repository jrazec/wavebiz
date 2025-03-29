<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Http\Middleware\RoleMiddleware;

class AuthController extends Controller
{
    // USE RBAC, AUTHORIZATION, AUTHENTICATION
    // will create a list here that contains different roles based access. 

    //FUNCTION FOR REGISTRATION
    public function registerUser(Request $request){

        // validate function accepts a parameter with rules, wherein inside contains a list of key-value pairs. variable=>rules 
        $validateUser = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
            'name' => 'required|string|max:255',
        ]);
    
        if ($validateUser->fails()) {
            return response()->json([
                'message' => $validateUser->errors(),
            ]);
        }   

        // CREATE CONTROLLER
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
            ]);
            
    
            return response()->json([
                'user' => $user,
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }


    }

    //FUNCTION FOR LOGIN
    public function loginUser(Request $request){

        // validate function accepts a parameter with rules, wherein inside contains a list of key-value pairs. variable=>rules 
        $validateUser = Validator::make($request->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);
    
        
        if ($validateUser->fails()) {
            return response()->json([
                'message' => $validateUser->errors(),
            ]);
        }
        $credentials = ['email'=>$request->email, 'password'=>$request->password];
  
        try {
            // if credentials isnt valid, will throw an error
            if (!auth()->attempt($credentials)){
                return response()->json(['error'=>'Invalid credentials'], 401);
            }
            // Checking if user exists
            $user = User::where('email', $request->email)->firstOrFail();

            // Creates a token for the found user..
            $user = Auth::user();
            $token = $user->createToken('auth_token',[
                'role_id' => $user->role_id,
            ])->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'user' => $user,
                'role_id' => $user->role_id,
            ],200);
           
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }

    }

    //FUNCTION FOR LOGOUT
    public function logoutUser(Request $request){
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'message' => 'Logged out',
            ],200);
        } catch (\Exception $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function index(){
        return response()->json([
            'message' => 'Welcome to the main dashboard',
        ]);
    }
}
