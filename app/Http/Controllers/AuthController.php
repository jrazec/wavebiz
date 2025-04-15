<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permission;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
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
            // Validate the request
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,fldEmail',
                'password' => 'required|min:6',
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,fldUserName',
                'createdBy' => 'required|string|max:255',
                'modifiedBy' => 'required|string|max:255',
                'role' => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors(),
                ], 422);
            }
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

    public function showSignup(){
        return view('member.signup');
    }
    public function showSignin(){
        return view('member.signin');
    }
    public function signup(Request $request){
        $validated = $request->validate([
            'fldUserID'         => 'required|string|max:20',
            'fldUserName'       => 'required|string|max:40|unique:Members,fldUserName',
            'fldPassword'       => 'required|string|min:6|max:64',
            'fldEmailAdd'       => 'nullable|email|max:300|unique:Members,fldEmailAdd',
            'fldFirstName'      => 'nullable|string|max:150',
            'fldMiddleName'     => 'nullable|string|max:150',
            'fldLastName'       => 'nullable|string|max:150',
            'fldNickName'       => 'nullable|string|max:100',
            'fldBirthDate'      => 'nullable|date|before:today',
            'fldCivilStatus'    => 'nullable|integer|in:0,1',
            'fldGender'         => 'nullable|integer|in:0,1',
            'fldNationality'    => 'nullable|string|max:150',
            'fldAgreeTerms'     => 'required|in:1',
            'fldTermsAndCondition' => 'nullable|string',
            'fldCellphone'      => 'nullable|string|max:50',
            'fldLandline'       => 'nullable|string|max:50',
            'fldBeneficiary'    => 'nullable|string',
            'fldRelationship'   => 'nullable|string|max:100',
            'fldSponsorID'      => 'nullable|integer|min:0',
            'fldDirectSponsorID' => 'nullable|integer|min:0',
        ]);
        // Hash the password before saving
        $validated['fldPassword'] = Hash::make($validated['fldPassword']);
        $validated['fldDateCreated'] = now();
        $member = Member::create($validated);
        Auth::login($member);
        return redirect()->route('member.dashboard');

    }
    public function signin(Request $request){
        $validated = $request->validate([
            'fldUserName'       => 'required|string|max:40',
            'fldPassword'       => 'required|string|min:6|max:64',
        ]);
       // Hash the password before checking
        $validated['fldPassword'] = Hash::make($validated['fldPassword']);
        if(Auth::attempt($validated)){
            $request->session()->regenerate();
            return redirect()->route('member.dashboard');
        }
        throw ValidationException::withMessages([
            'credentials' => 'The provided credentials do not match any records.',
        ]);
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('show.signin');
    }
}
