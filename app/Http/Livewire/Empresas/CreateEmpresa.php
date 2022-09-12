<?php

declare(strict_types=1);

namespace App\Http\Livewire\Empresas;

use App\Http\Livewire\Base;
use App\Models\Atividade;
use App\Models\Departamento;
use App\Models\Empresa;
use App\Models\Grupo;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;

use function flash;
use function redirect;
use function view;

class CreateEmpresa extends Base
{
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
    public $data_abertura = '';
    public $cliente_desde = '';
    public $cliente_ate = '';
    public $particularidades = '';

    public $grupos = [];
    public $departamentos = [];
    public $atividades = [];

    protected array $rules = [
        'cnpj'              => 'required|string|unique:empresas,cnpj',
        'nome'              => 'required|string',
        'grupo_id'          => 'required',
        'departamento_id'   => 'required',
        'atividade_id'      => 'required',
        'responsavel_departamento' => 'required',
    ];

    protected array $messages = [
        'cnpj.required' => 'O CNPJ é obrigatório',
        'cnpj.unique' => 'O CNPJ deve ser único. Volte na tela anterior e pesquise o cnpj inserido.',
        'nome.required' => 'O Nome é obrigatório',
        'grupo_id.required' => 'Favor informar o Grupo',
        'departamento_id.required' => 'Favor informar o Departamento',
        'atividade_id.required' => 'Favor informar a Atividade',
    ];

    public function mount()
    {
        $this->grupos = Grupo::all();
        $this->atividades = Atividade::all();
        $this->departamentos = Departamento::all();
    }

    /**
     * @throws ValidationException
     */
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function render(): View
    {
        return view('livewire.empresas.create');
    }

    public function store(): Redirector|RedirectResponse
    {
        $this->validate();
        $empresa = Empresa::create([
            'nome'  => mb_strtoupper($this->nome),
            'cnpj' => $this->cnpj,
            'fantasia' => $this->fantasia,
            'regime_tributario' => $this->regime_tributario,
            'periodo_apuracao' => $this->periodo_apuracao,
            'responsavel_departamento_pessoal' => $this->responsavel_departamento,
            'cep' => $this->cep,
            'logradouro' => $this->logradouro,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'email_fiscal' => $this->email_fiscal,
            'email_contabil' => $this->email_contabil,
            'email_financeiro' => $this->email_financeiro,
            'certificado' => $this->certificado,
            'certificado_validade' => $this->certificado_validade ? Carbon::createFromFormat("d/m/Y", $this->certificado_validade) : null,
            'contrato_social' => $this->contrato_social,
            'remoto_url' => $this->remoto_url,
            'remoto_usuario' => $this->remoto_usuario,
            'remoto_senha' => $this->remoto_senha,
            'sistema_url' => $this->sistema_url,
            'sistema_usuario' => $this->sistema_usuario,
            'sistema_senha' => $this->sistema_senha,
            'sefaz_url' => $this->sefaz_url,
            'sefaz_uf' => $this->sefaz_uf,
            'sefaz_ie' => $this->sefaz_ie,
            'sefaz_contador' => $this->sefaz_contador,
            'sefaz_usuario' => $this->sefaz_usuario,
            'sefaz_senha' => $this->sefaz_senha,
            'prefeitura_url' => $this->prefeitura_url,
            'prefeitura_usuario' => $this->prefeitura_usuario,
            'prefeitura_senha' => $this->prefeitura_senha,
            'grupo_id' => $this->grupo_id,
            'departamento_id' => $this->departamento_id,
            'atividade_id' => $this->atividade_id,
            'cliente_desde' => $this->cliente_desde ? Carbon::createFromFormat("d/m/Y", $this->cliente_desde) : null,
            'cliente_ate' => $this->cliente_ate ? Carbon::createFromFormat("d/m/Y", $this->cliente_ate) : null,
            'data_abertura' => $this->data_abertura ? Carbon::createFromFormat("d/m/Y", $this->data_abertura) : null,
            'particularidades' => $this->particularidades,
        ]);
        flash('Empresa criado')->success();
        return redirect()->route('empresas.index');
    }

    public function cancel(): void
    {
        $this->reset();
    }
}
