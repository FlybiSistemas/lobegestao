<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEmpresaAddDataCliente extends Migration
{
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->date('data_abertura')->nullable();
            $table->date('cliente_desde')->nullable();
            $table->date('cliente_ate')->nullable();
            $table->text('particularidades')->nullable();
            $table->string('ativo', 1)->default('A');
            $table->string('perfil', 1)->nullable();
        });
    }

    public function down()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->dropColumn('data_abertura');
            $table->dropColumn('cliente_desde');
            $table->dropColumn('cliente_ate');
            $table->dropColumn('particularidades');
            $table->dropColumn('ativo');
            $table->dropColumn('perfil');
        });
    }
}
