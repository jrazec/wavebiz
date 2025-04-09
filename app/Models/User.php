<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;

use Illuminate\Support\Facades\DB;

use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $primaryKey = 'fldID';

    protected $fillable = [
        'fldID',
        'fldUserName',
        'fldPassword',
        'fldEmail',
        'fldFirstName',
        'fldLastName',
        'fldDateCreated',
        'fldDateModified',
        'fldCreatedBy',
        'fldModifiedBy',
        'fldIsActive',
    ];

    // FOR RBAC
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasPermission($permission)
    {
        return $this->role->permissions->contains('name', $permission);
    }


    public function registerUser($email, $password, $firstName, $lastName, $username, $createdBy, $modifiedBy, $roleName)
    {
        try {
            // validate the input data if correk
            if (empty($email) || empty($password) || empty($firstName) || empty($lastName) || empty($username) || empty($roleName)) {
                return false;
            }

            // hashing
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO Users (fldUserName, fldPassword, fldEmail, fldFirstName, fldLastName, fldCreatedBy, fldModifiedBy,fldRoleName) VALUES (?, ?, ?, ?, ?, ?, ?,?)";
            DB::insert($query, [$username, $hashedPassword, $email, $firstName, $lastName, $createdBy, $modifiedBy, $roleName]);
            
            return true;
           
        } catch (\Exception $e) {
            // Handle exception
            return false;
        } 
    }
    public function getUserIDByEmail($email)
    {
        try {
            // Validate the input data
            if (empty($email)) {
                return false;
            }    

            // Fetch user from the database
            $query = "SELECT fldID FROM users WHERE fldEmail = ?";
            $stmt = DB::select($query, [$email]);

            return $stmt;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getUser($email, $password)
    {
        try {
            if (empty($email) || empty($password)) {
                return false;
            }
   
            $user = User::where('fldEmail', $email)->first();
    
            if ($user && password_verify($password, $user->fldPassword)) {
                return $user;
            }
    
            return false;
    
        } catch (\Exception $e) {
            return "Error fetching user: " . $e->getMessage();
        }
    }
      
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }



    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'fldPassword',
    ];
    

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
