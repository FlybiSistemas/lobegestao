<?php

declare(strict_types=1);

namespace App\Http\Livewire\Empresas;

use App\Http\Livewire\Base;
use App\Models\Atividade;
use App\Models\Contador;
use App\Models\Departamento;
use App\Models\Empresa;
use App\Models\Grupo;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use App\Helpers\FormatterHelper;

use function flash;
use function redirect;
use function view;

class EditEmpresa extends Base
{
    public ?Empresa $empresa = null;
    public $nome = '';
    public $cnpj = '';
    public $fantasia = '';
    public $regime_tributario = '';
    public $periodo_apuracao = '';
    public $responsavel_departamento = '';
    public $cep = '';
    public $logradouro = '';
    public $bairro = '';
    public $cidade = '';
    public $estado = '';
    public $email_fiscal = '';
    public $email_contabil = '';
    public $email_financeiro = '';
    public $certificado = '';
    public $certificado_validade = '';
    public $contrato_social = '';
    public $remoto_url = '';
    public $remoto_usuario = '';
    public $remoto_senha = '';
    public $sistema_url = '';
    public $sistema_usuario = '';
    public $sistema_senha = '';
    public $sefaz_url = '';
    public $sefaz_uf = '';
    public $sefaz_ie = '';
    public $sefaz_contador = '';
    public $sefaz_usuario = '';
    public $sefaz_senha = '';
    public $prefeitura_url = '';
    public $prefeitura_usuario = '';
    public $prefeitura_senha = '';
    public $grupo_id = '';
    public $departamento_id = '';
    public $atividade_id = '';
    public $contador_id = '';
    public $data_abertura = '';
    public $cliente_desde = '';
    public $cliente_ate = '';
    public $particularidades = '';

    public $grupos = [];
    public $departamentos = [];
    public $atividades = [];
    public $contadores = [];

    protected function rules(): array
    {
        return [
            'cnpj'                      => 'required|string|unique:empresas,cnpj,' . $this->empresa->id,
            'nome'                      => 'required|string',
            'grupo_id'                  => 'required',
            'departamento_id'           => 'required',
            'atividade_id'              => 'required',
            'responsavel_departamento'  => 'required',
        ];
    }

    protected array $messages = [
        'cnpj.required'                     => 'O CNPJ é obrigatório',
        'cnpj.unique'                       => 'O CNPJ deve ser único. Volte na tela anterior e pesquisa o cnpj inserido.',
        'nome.required'                     => 'O Nome é obrigatório',
        'grupo_id.required'                 => 'Favor informar o Grupo',
        'departamento_id.required'          => 'Favor informar o Departamento',
        'atividade_id.required'             => 'Favor informar a Atividade',
        'responsavel_departamento.required' => 'Favor informar o Responsável',
    ];

    /**
     * @throws ValidationException
     */
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function mount(): void
    {
        $this->grupos = Grupo::all();
        $this->atividades = Atividade::all();
        $this->departamentos = Departamento::all();
        $this->contadores = Contador::all();
        $this->nome = $this->empresa->nome ?? '';
        $this->cnpj = $this->empresa->cnpj ?? '';
        $this->fantasia = $this->empresa->fantasia ?? '';
        $this->regime_tributario = $this->empresa->regime_tributario ?? '';
        $this->periodo_apuracao = $this->empresa->periodo_apuracao ?? '';
        $this->responsavel_departamento = $this->empresa->responsavel_departamento_pessoal ?? '';
        $this->cep = $this->empresa->cep ?? '';
        $this->logradouro = $this->empresa->logradouro ?? '';
        $this->bairro = $this->empresa->bairro ?? '';
        $this->cidade = $this->empresa->cidade ?? '';
        $this->estado = $this->empresa->estado ?? '';
        $this->email_fiscal = $this->empresa->email_fiscal ?? '';
        $this->email_contabil = $this->empresa->email_contabil ?? '';
        $this->email_financeiro = $this->empresa->email_financeiro ?? '';
        $this->certificado = $this->empresa->certificado ?? '';
        $this->certificado_validade = $this->empresa->certificado_validade ? $this->empresa->certificado_validade->format('d/m/Y') : '';
        $this->contrato_social = $this->empresa->contrato_social ?? '';
        $this->remoto_url = $this->empresa->remoto_url ?? '';
        $this->remoto_usuario = $this->empresa->remoto_usuario ?? '';
        $this->remoto_senha = $this->empresa->remoto_senha ?? '';
        $this->sistema_url = $this->empresa->sistema_url ?? '';
        $this->sistema_usuario = $this->empresa->sistema_usuario ?? '';
        $this->sistema_senha = $this->empresa->sistema_senha ?? '';
        $this->sefaz_url = $this->empresa->sefaz_url ?? '';
        $this->sefaz_uf = $this->empresa->sefaz_uf ?? '';
        $this->sefaz_ie = $this->empresa->sefaz_ie ?? '';
        $this->sefaz_contador = $this->empresa->sefaz_contador ?? '';
        $this->sefaz_usuario = $this->empresa->sefaz_usuario ?? '';
        $this->sefaz_senha = $this->empresa->sefaz_senha ?? '';
        $this->prefeitura_url = $this->empresa->prefeitura_url ?? '';
        $this->prefeitura_usuario = $this->empresa->prefeitura_usuario ?? '';
        $this->prefeitura_senha = $this->empresa->prefeitura_senha ?? '';
        $this->particularidades = $this->empresa->particularidades ?? '';
        $this->data_abertura = $this->empresa->data_abertura ? $this->empresa->data_abertura->format('d/m/Y') : '';
        $this->cliente_desde = $this->empresa->cliente_desde ? $this->empresa->cliente_desde->format('d/m/Y') : '';
        $this->cliente_ate = $this->empresa->cliente_ate ? $this->empresa->cliente_ate->format('d/m/Y') : '';

        $this->grupo_id = $this->empresa->grupo_id ?? '';
        $this->departamento_id = $this->empresa->departamento_id ?? '';
        $this->atividade_id = $this->empresa->atividade_id ?? '';
        $this->contador_id = $this->empresa->contador_id ?? '';
    }

    public function render(): View
    {
        return view('livewire.empresas.edit');
    }

    public function update(): Redirector|RedirectResponse
    {
        $this->validate();

        $this->empresa->nome  = mb_strtoupper($this->nome);
        $this->empresa->cnpj = FormatterHelper::onlyNumbers($this->cnpj);
        $this->empresa->fantasia = $this->fantasia;
        $this->empresa->regime_tributario = $this->regime_tributario;
        $this->empresa->periodo_apuracao = $this->periodo_apuracao;
        $this->empresa->responsavel_departamento_pessoal = $this->responsavel_departamento;
        $this->empresa->cep = $this->cep;
        $this->empresa->logradouro = $this->logradouro;
        $this->empresa->bairro = $this->bairro;
        $this->empresa->cidade = $this->cidade;
        $this->empresa->estado = $this->estado;
        $this->empresa->email_fiscal = $this->email_fiscal;
        $this->empresa->email_contabil = $this->email_contabil;
        $this->empresa->email_financeiro = $this->email_financeiro;
        $this->empresa->certificado = $this->certificado;
        $this->empresa->certificado_validade = $this->certificado_validade ? Carbon::createFromFormat("d/m/Y", $this->certificado_validade) : null;
        $this->empresa->contrato_social = $this->contrato_social;
        $this->empresa->remoto_url = $this->remoto_url;
        $this->empresa->remoto_usuario = $this->remoto_usuario;
        $this->empresa->remoto_senha = $this->remoto_senha;
        $this->empresa->sistema_url = $this->sistema_url;
        $this->empresa->sistema_usuario = $this->sistema_usuario;
        $this->empresa->sistema_senha = $this->sistema_senha;
        $this->empresa->sefaz_url = $this->sefaz_url;
        $this->empresa->sefaz_uf = $this->sefaz_uf;
        $this->empresa->sefaz_ie = $this->sefaz_ie;
        $this->empresa->sefaz_contador = $this->sefaz_contador;
        $this->empresa->sefaz_usuario = $this->sefaz_usuario;
        $this->empresa->sefaz_senha = $this->sefaz_senha;
        $this->empresa->prefeitura_url = $this->prefeitura_url;
        $this->empresa->prefeitura_usuario = $this->prefeitura_usuario;
        $this->empresa->prefeitura_senha = $this->prefeitura_senha;
        $this->empresa->grupo_id = $this->grupo_id;
        $this->empresa->departamento_id = $this->departamento_id;
        $this->empresa->atividade_id = $this->atividade_id;
        $this->empresa->data_abertura = $this->data_abertura ? Carbon::createFromFormat("d/m/Y", $this->data_abertura) : null;
        $this->empresa->cliente_desde = $this->cliente_desde ? Carbon::createFromFormat("d/m/Y", $this->cliente_desde) : null;
        $this->empresa->cliente_ate = $this->cliente_ate ? Carbon::createFromFormat("d/m/Y", $this->cliente_ate) : null;
        $this->empresa->particularidades = $this->particularidades;
        $this->empresa->save();
        flash('Empresa atualizado')->success();
        return redirect()->route('empresas.index');
    }
}
