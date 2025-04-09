<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Http\Middleware\RoleMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;

//import log here
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // USE RBAC, AUTHORIZATION, AUTHENTICATION
    // will create a list here that contains different roles based access. 

    //FUNCTION FOR REGISTRATION
    public function registerUser(Request $request){

        // CREATE CONTROLLER
        try {
            // $email, $password, $firstName, $lastName, $username, $createdBy, $modifiedBy
            $uTable = new User();
            $pTable = new Permission();
            $createUser = $uTable->registerUser(
                $request->email,
                $request->password,
                $request->fname,
                $request->lname,
                $request->username,
                $request->createdBy,
                $request->modifiedBy,
                $request->role,
            );
            if($createUser == false){
                return response()->json([
                    'message' => 'User not created',
                ]);
            }

            $userID = $uTable->getUserIDByEmail($request->email); 
            $permissionID = $pTable->getPermissionIDByName($request->role); 
            // ($userID, $permissionID,$roleName, $moduleID, $canView, $canAdd, $canEdit, $canDelete)

            $userPermission = $pTable->setUserPermission($userID, $permissionID);

            return response()->json([
                'createUser' => $createUser,
                'userID' => $userID,
                'permissionID' => $permissionID,
                'userPermission' => $userPermission,
                'status' => 'success',
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }


    }

    public function addRole(Request $request){
        try {
            $pTable = new Permission();

            $permission = $pTable->addPermission(
                $request->roleName,
                $request->moduleID,
                $request->canView,
                $request->canAdd,
                $request->canEdit,
                $request->canDelete
            );
            // If the permission contains SQL like SQL state, it means that the permission was not added successfully
            $status = (str_contains($permission,'SQL')) ? "error" : "permission"; 
            return response()->json([
                $status => $permission,
            ],200);
        } catch (\Exception $e) {
            return false;
        }
    }

    //FUNCTION FOR LOGIN
    public function loginUser(Request $request)
    {
        $credentials = $request->only(['loginEmail', 'loginPassword']);
    
        // Ensure the email exists
        $user = User::where('fldEmail', $credentials['loginEmail'])->first();
        if (!$user) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        
        // Check if the password matches the hashed version in the DB
        if (!Hash::check($credentials['loginPassword'], $user->fldPassword)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        
        // If the user exists and the password matches, generate JWT token
        $token = JWTAuth::fromUser($user);
    
        // Debug: Log the token
        \Log::info('Generated JWT Token: ' . $token);
        
        return response()->json([
            'status' => true,
            'token' => $token,
            'fldRoleName' => $user->fldRoleName
        ]);
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
