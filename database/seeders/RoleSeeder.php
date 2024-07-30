<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'super-admin',
            'admin',
            'user',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        $permissions = [
            'create user',
            'read user',
            'update user',
            'delete user',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::findByName('super-admin');

        $role->givePermissionTo(Permission::all());

        $role = Role::findByName('admin');

        $role->givePermissionTo([
            'create user',
            'read user',
            'update user',
            'delete user',
        ]);

        $role = Role::findByName('user');

        $role->givePermissionTo([
            'read user',
        ]);

        
    }
}
