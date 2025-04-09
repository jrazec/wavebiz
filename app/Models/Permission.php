<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//import DB
use Illuminate\Support\Facades\DB;


class Permission extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'fldID',
        'fldRoleName',
        'fldModuleID',
        'fldCanView',
        'fldCanAdd',
        'fldCanEdit',
        'fldCanDelete',
        'created_at',
        'updated_at',
    ];

    public function addPermission($roleName, $moduleID, $canView, $canAdd, $canEdit, $canDelete)
    {
        try {
            // Validate the input data
            if (empty($roleName) || empty($moduleID)) {
                return false;
            }
            $canAdd = $canAdd ? 1 : 0;
            $canEdit = $canEdit ? 1 : 0;
            $canDelete = $canDelete ? 1 : 0;
            $canView = $canView ? 1 : 0;
            
            // Insert the permission into the database
            $query = "INSERT INTO permissions (fldRoleName, fldModuleID, fldCanView, fldCanAdd, fldCanEdit, fldCanDelete) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = DB::insert($query, [$roleName, $moduleID, $canView, $canAdd, $canEdit, $canDelete]);
            
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function setUserPermission($userID, $permissionsID)
    {
        try {
            
            $userID = $userID[0]->fldID;
            // create a list of permissionsId-which is an object that contains fldID 
            
            $permissionList = [];
            foreach ($permissionsID as $permission) {
                array_push($permissionList, $permission->fldID);
            }
            
           
            foreach ($permissionList as $permissionID) {
                // Validate the input data
                if (empty($userID) || empty($permissionID)) {
                    return false;
                }
                
                // Insert the user permission into the database
                $query2 = "INSERT INTO User_Permissions (fldUserID,fldPermissionID,created_at,updated_at) VALUES (?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                $stmt = DB::insert($query2, [$userID, $permissionID]);
            }
            
            
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function getPermissionIDByName($roleName)
    {
        try {
            // Validate the input data
            if (empty($roleName)) {
                return $roleName;
            }

            // Fetch permissions from the database
            $query = "SELECT fldID FROM permissions WHERE fldRoleName = ?";
            $stmt = DB::select($query, [$roleName]);

            return $stmt;
        } catch (\Exception $e) {
            return false;
        }
    }

    
}
