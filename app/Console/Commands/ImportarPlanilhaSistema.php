<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportarPlanilhaSistema extends Command
{
    protected $signature = 'lobe:importar-sistema';
    protected $description = 'Temporário. Importar a planilha com os acessos do sistema do cliente';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Log::info("Início da importação");
        $file = "/home1/lobege28/lobegestao/acesso-sistema.csv";
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
                $tipo = $data[3];
                $usuario_remoto = $data[4];
                $senha_remoto = $data[5];
                $usuario_sistema = $data[6];
                $senha_sistema = $data[7];

                $cnpj = $this->onlyNumbers($cnpj);
                $empresa = DB::table('empresas')->where('cnpj', "=", $cnpj)->first();
                Log::info("Linha: {$linha} \tCNPJ: {$cnpj} \tEmpresa: {$empresa->id}|{$empresa->nome}");

                if (!$empresa) {
                    Log::error("CNPJ: {$cnpj} não encontrado");
                }
                $dados = [
                    'remoto_url'        => $tipo,
                    'remoto_usuario'    => $usuario_remoto,
                    'remoto_senha'      => $senha_remoto,
                    'sistema_usuario'   => $usuario_sistema,
                    'sistema_senha'     => $senha_sistema,
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
