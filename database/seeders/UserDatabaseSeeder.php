<?php

namespace Database\Seeders;

use App\Models\Roles\Permission;
use App\Models\Roles\Role;
use App\Models\Roles\RoleUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class UserDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        //create developer uncomment to use when seeding
        /*
        $user = User::firstOrCreate(['email' => 'usuario@lobeconsultoria.com.br'], [
            'name'                 => 'Usuário',
            'slug'                 => 'usuario',
            'email'                => 'usuario@lobeconsultoria.com.br',
            'password'             => bcrypt('usuario@1008'),
            'is_active'            => 1,
            'is_office_login_only' => 0
        ]);

        //generate image
        $name      = get_initials($user->name);
        $id        = $user->id.'.png';
        $path      = 'users/';
        $imagePath = create_avatar($name, $id, $path);

        //save image
        $user->image = $imagePath;
        $user->save();

        $role = Role::where('name', 'admin')->first();
        RoleUser::firstOrCreate([
            'role_id' => $role->id,
            'user_id' => $user->id
        ]);
        */
    }
}
