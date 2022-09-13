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
        Schema::create('lancamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->nullable()->constrained('empresas');
            $table->date('data_lancamento')->comment("Data do lançamento da apuração");
            $table->decimal('valor_apurado', 15, 2)->nullable();
            $table->decimal('valor_declarado', 15, 2)->nullable();
            $table->decimal('valor_recolhido', 15, 2)->nullable();
            $table->decimal('resultado', 15, 2)->nullable()->comment("Resultado da diferença entre o apurado e o recolhido");
            $table->string('tipo', 1)->comment("Indica qual o tipo de lançamento. ICMS, PIS, PROTEGE e etc.");
            $table->timestamps();
        });

        Permission::firstOrCreate(['name' => 'ver_lancamentos',       'description' => 'Ver lançamentos',        'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'adicionar_lancamento',  'description' => 'Adicionar lançamento',   'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'editar_lancamento',     'description' => 'Editar lançamento',      'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'excluir_lancamento',    'description' => 'Excluir lançamento',     'guard_name' => 'web']);

        $role = Role::firstOrCreate(['name' => 'admin']);;
        $permissions = Permission::all();
        foreach ($permissions as $perm) {
            $role->givePermissionTo($perm->name);
        }
    }

    public function down()
    {
        Schema::dropIfExists('lancamentos');
    }
};
