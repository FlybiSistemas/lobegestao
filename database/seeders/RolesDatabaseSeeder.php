<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'usuario']);

        $roles = Role::all();
        $permissions = Permission::all();
        foreach ($roles as $role) {
            foreach ($permissions as $perm) {
                $role->givePermissionTo($perm->name);
            }
        }
    }
}
