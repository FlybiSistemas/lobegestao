<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEmpresaAddCamposContatos extends Migration
{
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->string('nome_contato')->nullable();
            $table->string('primeiro_contato')->nullable();
            $table->string('segundo_contato')->nullable();
        });
    }

    public function down()
    {
        Schema::dropColumns('empresas', function (Blueprint $table) {
            $table->dropColumn('nome_contato');
            $table->dropColumn('primeiro_contato');
            $table->dropColumn('segundo_contato');
        });
    }
}
