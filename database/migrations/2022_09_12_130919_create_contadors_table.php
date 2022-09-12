<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contadores', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 150);
            $table->string('usuario', 50);
            $table->string('senha', 50);
            $table->timestamps();
        });

        Schema::table('empresas', function (Blueprint $table) {
            $table->foreignId('contador_id')->nullable()->constrained('contadores');
        });

        Permission::firstOrCreate(['name' => 'ver_contadores',      'description' => 'Ver contadores',       'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'adicionar_contador',  'description' => 'Adicionar contador',   'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'editar_contador',     'description' => 'Editar contador',      'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'excluir_contador',    'description' => 'Excluir contador',     'guard_name' => 'web']);

        $role = Role::firstOrCreate(['name' => 'admin']);;
        $permissions = Permission::all();
        foreach ($permissions as $perm) {
            $role->givePermissionTo($perm->name);
        }
    }

    public function down()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->dropColumn('contador_id');
        });
        Schema::dropIfExists('contadores');
    }
};
