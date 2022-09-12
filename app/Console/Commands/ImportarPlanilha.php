<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportarPlanilha extends Command
{
    protected $signature = 'lobe:importar-planilha';
    protected $description = 'Temporário. Importar a planilha base';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Log::info("Início da importação");
        $file = "/home1/lobege28/lobegestao/cadastros.csv";
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
                $nome = $data[1];
                $grupoEmpresaNome = $data[2];
                $grupoLobe = $data[3];
                $tipo = $data[4];
                $regimeTributarioNome = $data[5];
                $periodoApuracaoNome = $data[6];
                $certificado = $data[7];
                $certificadoValidade = $data[8];
                $contratoSocial = $data[9];
                $estado = $data[10]; // não é usado
                $cidade = $data[11]; // não é usado
                $emailFiscal = $data[12];
                $emailContabil = $data[13];
                $emailFinanceiro = $data[14];
                $responsavelDepartamentoPessoal = $data[17];

                $cnpj = $this->onlyNumbers($cnpj);
                Log::info("Linha: {$linha} \tCNPJ: {$cnpj}");
                // pegar Grupo
                $grupoId = null;
                if ($grupoEmpresaNome) {
                    $grupoEmpresa = DB::table('grupos')->where('nome', $grupoEmpresaNome)->first();
                    if (!$grupoEmpresa) {
                        $grupoId = DB::table('grupos')->insertGetId([
                            'nome' => mb_strtoupper($grupoEmpresaNome),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    } else {
                        $grupoId = $grupoEmpresa->id;
                    }
                }
                $departamentoId = null;
                if ($grupoLobe) {
                    $departamento = DB::table('departamentos')->where('nome', $grupoLobe)->first();
                    if (!$departamento) {
                        $departamentoId = DB::table('departamentos')->insertGetId([
                            'nome' => mb_strtoupper($grupoLobe),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    } else {
                        $departamentoId = $departamento->id;
                    }
                }
                $atividadeId = null;
                if ($tipo) {
                    $atividade = DB::table('atividades')->where('nome', $tipo)->first();
                    if (!$atividade) {
                        $atividadeId = DB::table('atividades')->insertGetId([
                            'nome' => mb_strtoupper($tipo),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    } else {
                        $atividadeId = $atividade->id;
                    }
                }

                // valida o regime tributario
                $regimeTributario = "S";
                if ($regimeTributarioNome == "LUCRO REAL") {
                    $regimeTributario = 'R';
                } else if ($regimeTributarioNome == "LUCRO PRESUMIDO") {
                    $regimeTributario = 'P';
                }
                // valida o periodo apuracao
                $periodoApuracao = "M";
                if ($periodoApuracaoNome == "TRIMESTRAL") {
                    $periodoApuracao = 'T';
                }
                $vencimentoCertificado = null;
                if ($certificadoValidade && $certificadoValidade != "PREENCHER" && $certificadoValidade != "CÓDIGO DE ACESSO" && $certificadoValidade != "VENCIDO") {
                    Log::info("Data: {$certificadoValidade}");
                    $vencimentoCertificado = Carbon::createFromFormat("d/m/Y", $certificadoValidade);
                }

                $empresa = DB::table('empresas')->where('cnpj', "=", $cnpj)->first();
                if (!$empresa) {
                    $empresaId = DB::table('empresas')->insertGetId([
                        'grupo_id'                          => $grupoId,
                        'departamento_id'                   => $departamentoId,
                        'atividade_id'                      => $atividadeId,
                        'nome'                              => mb_strtoupper($nome),
                        'cnpj'                              => $cnpj,
                        'cidade'                            => mb_strtoupper($cidade),
                        'estado'                            => mb_strtoupper($estado),
                        'regime_tributario'                  => $regimeTributario,
                        'periodo_apuracao'                   => $periodoApuracao,
                        'certificado'                       => $certificado,
                        'certificado_validade'               => $vencimentoCertificado,
                        'contrato_social'                    => $contratoSocial,
                        'email_fiscal'                       => mb_strtolower($emailFiscal),
                        'email_contabil'                     => mb_strtolower($emailContabil),
                        'email_financeiro'                   => mb_strtolower($emailFinanceiro),
                        'responsavel_departamento_pessoal'    => mb_strtoupper($responsavelDepartamentoPessoal),
                    ]);
                    $empresa = DB::table('empresas')->where('id', $empresaId)->first();
                }
                Log::info("Empresa: {$empresa->id}");
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

    public function formatFone($value)
    {
        $FONE_LENGTH = 11;
        $fone = $this->onlyNumbers($value); //preg_replace("/\D/", '', $value);
        if (strlen($fone) === $FONE_LENGTH) {
            return preg_replace("/(\d{2})(\d{5})(\d{4})/", "(\$1) \$2-\$3", $fone);
        }
        return preg_replace("/(\d{2})(\d{4})(\d{4})/", "(\$1) \$2-\$3", $fone);
    }
}
