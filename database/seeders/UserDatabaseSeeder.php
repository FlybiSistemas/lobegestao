<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class UserDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        //create developer uncomment to use when seeding
        $user = User::firstOrCreate(['email' => 'admin@lobeconsultoria.com.br'], [
            'name'                 => 'Administrador',
            'slug'                 => 'administrador',
            'email'                => 'admin@lobeconsultoria.com.br',
            'password'             => bcrypt('admin@1008')
        ]);
        $user->assignRole('admin');
    }
}
