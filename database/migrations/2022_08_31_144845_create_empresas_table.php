<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grupo_id')->nullable()->constrained('grupos');
            $table->foreignId('departamento_id')->nullable()->constrained('departamentos');
            $table->foreignId('atividade_id')->nullable()->constrained('atividades');
            $table->string('cnpj', 14);
            $table->string('nome', 255);
            $table->string('fantasia', 255)->nullable();
            $table->string('tipo')->nullable();
            $table->string('regime_tributario')->nullable();
            $table->string('periodo_apuracao')->nullable();
            $table->string('logradouro')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('cep')->nullable();
            $table->string('email_fiscal')->nullable();
            $table->string('email_contabil')->nullable();
            $table->string('email_financeiro')->nullable();
            $table->string('responsavel_departamento_pessoal')->nullable();
            $table->text('certificado')->nullable();
            $table->date('certificado_validade')->nullable();
            $table->text('contrato_social')->nullable();
            $table->string('remoto_url', 255)->nullable();
            $table->string('remoto_usuario', 100)->nullable();
            $table->string('remoto_senha', 100)->nullable();
            $table->string('sistema_url', 255)->nullable();
            $table->string('sistema_usuario', 100)->nullable();
            $table->string('sistema_senha', 100)->nullable();
            $table->string('sefaz_url', 255)->nullable();
            $table->string('sefaz_uf', 2)->nullable();
            $table->string('sefaz_ie', 30)->nullable();
            $table->string('sefaz_contador', 100)->nullable();
            $table->string('sefaz_usuario', 100)->nullable();
            $table->string('sefaz_senha', 100)->nullable();
            $table->string('prefeitura_url', 255)->nullable();
            $table->string('prefeitura_uf', 2)->nullable();
            $table->string('prefeitura_cidade', 150)->nullable();
            $table->string('prefeitura_usuario', 100)->nullable();
            $table->string('prefeitura_senha', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('empresas');
    }
};
