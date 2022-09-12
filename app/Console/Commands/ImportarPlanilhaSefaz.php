<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Empresa;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportarPlanilhaSefaz extends Command
{
    protected $signature = 'lobe:importar-sefaz';
    protected $description = 'Temporário. Importar a planilha com os acessos da sefaz';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Log::info("Início da importação");
        $file = "/home/carlos/Downloads/acesso-sefaz.csv";
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
                $ie = $data[4];
                $contador = $data[5];
                $usuario = $data[6];
                $senha = $data[7];
                $url = $data[8];

                $cnpj = $this->onlyNumbers($cnpj);
                $usuario = $this->onlyNumbers($usuario);
                $empresa = DB::table('empresas')->where('cnpj', "=", $cnpj)->first();
                Log::info("Linha: {$linha} \tCNPJ: {$cnpj} \tEmpresa: {$empresa->id}|{$empresa->nome}");

                if (!$empresa) {
                    Log::error("CNPJ: {$cnpj} não encontrado");
                }
                $dadosSefaz = [
                    'sefaz_url'         => $url,
                    'sefaz_ie'          => $ie,
                    'sefaz_contador'    => $contador,
                    'sefaz_usuario'     => $usuario,
                    'sefaz_senha'       => $senha,
                ];
                DB::table('empresas')->where('id', $empresa->id)->update($dadosSefaz);
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
