<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class RolesDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'usuario']);
    }
}
