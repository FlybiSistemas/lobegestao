<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEmpresaAddCamposBot extends Migration
{
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->boolean('bot_icms')->nullable();
            $table->boolean('bot_pis_cofins')->nullable();
        });
    }

    public function down()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->dropColumn('bot_icms');
            $table->dropColumn('bot_pis_cofins');
        });
    }
}
