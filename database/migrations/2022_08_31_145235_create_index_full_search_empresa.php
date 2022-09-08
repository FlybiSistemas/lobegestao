<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (env('APP_ENV') !== 'testing') {
            DB::statement('ALTER TABLE empresas ADD FULLTEXT (nome, cnpj, fantasia)');
            DB::statement('ALTER TABLE grupos ADD FULLTEXT (nome)');
            DB::statement('ALTER TABLE departamentos ADD FULLTEXT (nome)');
            DB::statement('ALTER TABLE atividades ADD FULLTEXT (nome)');
        }
    }

    public function down()
    {
    }
};
