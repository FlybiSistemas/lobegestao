<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportarPlanilhaPrefeitura extends Command
{
    protected $signature = 'lobe:importar-prefeitura';
    protected $description = 'Temporário. Importar a planilha com os acessos da prefeitura do cliente';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Log::info("Início da importação");
        $file = "/home/carlos/Downloads/acesso-prefeitura.csv";
        $handleFile = fopen($file, "r");
        $linha = 0;
        try {
            DB::beginTransaction();
            while (($data = fgetcsv($handleFile, 10000, ";")) != false) {
                if ($linha == 0) {
                    $linha++;
                    continue;
                }
                $cnpj = $data[0];
                $prefeitura_usuario = $data[4];
                $prefeitura_senha = $data[5];
                $prefeitura_url = $data[6];

                $cnpj = $this->onlyNumbers($cnpj);
                $empresa = DB::table('empresas')->where('cnpj', "=", $cnpj)->first();
                Log::info("Linha: {$linha} \tCNPJ: {$cnpj} \tEmpresa: {$empresa->id}|{$empresa->nome}");

                if (!$empresa) {
                    Log::error("CNPJ: {$cnpj} não encontrado");
                }

                $dados = [
                    'prefeitura_url'        => $prefeitura_url,
                    'prefeitura_usuario'    => $prefeitura_usuario,
                    'prefeitura_senha'      => $prefeitura_senha,
                ];
                DB::table('empresas')->where('id', $empresa->id)->update($dados);
                $linha++;
            }
            DB::commit();
            Log::info("Salvo na nova base");
        } catch (\Exception $e) {
            Log::error("Ocorreu um erro ao importar: {$e->getMessage()}");
            DB::rollBack();
            return false;
        }
        fclose($handleFile);
    }

    public function onlyNumbers($value)
    {
        return preg_replace("/\D/", '', $value);
    }

    public function completeWithZeros($value, $size)
    {
        return str_pad($value, $size, '0', STR_PAD_LEFT);
    }
}
