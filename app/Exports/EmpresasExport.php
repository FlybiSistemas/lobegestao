<?php

namespace App\Exports;

use App\Helpers\RegimeApuracaoHelper;
use App\Helpers\RegimeTributarioHelper;
use App\Models\Empresa;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmpresasExport implements FromCollection, WithHeadings, WithStyles
{
    use Exportable;

    public function collection()
    {
        $dados = Empresa::with('atividade')
            ->with('departamento')
            ->with('grupo')
            ->with('grupo')
            ->get();

        return $dados->map(function ($empresa) {
            return [
                'Razão Social' => $empresa->nome,
                'Fundação' => $empresa->data_abertura,
                'Cliente desde' => $empresa->cliente_desde,
                'CNPJ' => "'".$empresa->cnpj,
                'Endereço' => $empresa->logradouro,
                'Cidade' => $empresa->cidade,
                'Estado' => $empresa->estado,
                'Grupo' => $empresa->grupo ? $empresa->grupo->nome : '',
                'Departamento' => $empresa->departamento ? $empresa->departamento->nome : '',
                'Atividade' => $empresa->atividade ? $empresa->atividade->nome : '',
                'Responsável DP' => $empresa->responsavel_departamento_pessoal,
                'Regime Tributário' => $empresa->regime_tributario != '' ? RegimeTributarioHelper::get($empresa->regime_tributario) : '',
                'Regime Apuração' => $empresa->periodo_apuracao != '' ? RegimeApuracaoHelper::get($empresa->periodo_apuracao) : '',
                'Validade Certificado' => $empresa->certificado_validade,
                'Contato Fiscal' => $empresa->email_fiscal,
                'Contato Contábil' => $empresa->email_contabil,
                'Contato Financeiro' => $empresa->email_financeiro,
                'Acesso Remoto URL' => $empresa->remoto_url,
                'Usuário Remoto' => $empresa->remoto_usuario,
                'Senha Remoto' => $empresa->remoto_senha,
                'Acesso ao Sistema' => $empresa->sistema_url,
                'Usuário Sistema' => $empresa->sistema_usuario,
                'Senha Sistema' => $empresa->sistema_senha,
                'Acesso Prefeitura' => $empresa->prefeitura_url,
                'Usuário Prefeitura' => $empresa->prefeitura_usuario,
                'Senha Prefeitura' => $empresa->prefeitura_senha,
                'Acesso SEFAZ' => $empresa->sefaz_url,
                'Usuário SEFAZ' => $empresa->sefaz_usuario,
                'Senha SEFAZ' => $empresa->sefaz_senha,
                'Estado SEFAZ' => $empresa->sefaz_uf,
                'Contador SEFAZ' => $empresa->sefaz_contador,
                'Inscrição Estadua' => $empresa->sefaz_ie,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Razão Social',
            'Fundação',
            'Cliente desde',
            'CNPJ',
            'Endereço',
            'Cidade',
            'Estado',
            'Grupo',
            'Departamento',
            'Atividade',
            'Responsável DP',
            'Regime Tributário',
            'Regime Apuração',
            'Validade Certificado',
            'Contato Fiscal',
            'Contato Contábil',
            'Contato Financeiro',
            'Acesso Remoto URL',
            'Usuário Remoto',
            'Senha Remoto',
            'Acesso ao Sistema',
            'Usuário Sistema',
            'Senha Sistema',
            'Acesso Prefeitura',
            'Usuário Prefeitura',
            'Senha Prefeitura',
            'Acesso SEFAZ',
            'Usuário SEFAZ',
            'Senha SEFAZ',
            'Estado SEFAZ',
            'Contador SEFAZ',
            'Inscrição Estadual'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['argb' => 'FFFFFFFF'],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['argb' => 'FF002060'],
                ],
                'autoSize' => true,
            ],
        ];
    }
}
