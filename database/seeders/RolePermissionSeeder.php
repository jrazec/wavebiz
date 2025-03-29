<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $admin = Role::create(['name' => 'Admin']);
        $member = Role::create(['name' => 'Member']);
    
        $manageUsers = Permission::create(['name' => 'manageUsers']);
        $admin->permissions()->attach($manageUsers);
    }
}
