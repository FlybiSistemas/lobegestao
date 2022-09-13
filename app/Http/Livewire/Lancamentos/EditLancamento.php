<?php

declare(strict_types=1);

namespace App\Http\Livewire\Lancamentos;

use App\Http\Livewire\Base;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use App\Helpers\FormatterHelper;
use App\Models\Lancamento;

use function flash;
use function redirect;
use function view;

class EditLancamento extends Base
{
    public ?Lancamento $lancamento = null;
    public $data_lancamento = '';
    public $valor_apurado = '';
    public $valor_declarado = '';
    public $valor_recolhido = '';
    public $resultado = '';
    public $tipo = '';

    protected array $rules = [
        'data_lancamento'   => 'required',
        'valor_apurado'     => 'required',
        'valor_declarado'   => 'required',
        'valor_recolhido'   => 'required',
        'resultado'         => 'required',
        'tipo'              => 'required',
    ];

    protected array $messages = [
        'data_lancamento.required'  => 'Obrigatório',
        'valor_apurado.required'    => 'Obrigatório',
        'valor_declarado.required'  => 'Obrigatório',
        'valor_recolhido.required'  => 'Obrigatório',
        'resultado.required'        => 'Obrigatório',
        'tipo.required'             => 'Obrigatório',
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
        $this->data_lancamento = $this->lancamento->data_lancamento ? $this->lancamento->data_lancamento->format('d/m/Y') : '';
        $this->valor_apurado = $this->lancamento->valor_apurado ?? '';
        $this->valor_declarado = $this->lancamento->valor_declarado ?? '';
        $this->valor_recolhido = $this->lancamento->valor_recolhido ?? '';
        $this->resultado = $this->lancamento->resultado ?? '';
        $this->tipo = $this->lancamento->tipo ?? '';
    }

    public function render(): View
    {
        return view('livewire.lancamentos.edit');
    }

    public function update(): Redirector|RedirectResponse
    {
        $this->validate();

        $this->lancamento->data_lancamento = $this->data_lancamento ? Carbon::createFromFormat("d/m/Y", $this->data_lancamento) : null;
        $this->lancamento->valor_apurado  = $this->valor_apurado;
        $this->lancamento->valor_recolhido = $this->valor_recolhido;
        $this->lancamento->valor_declarado = $this->valor_declarado;
        $this->lancamento->resultado = $this->resultado;
        $this->lancamento->tipo = $this->tipo;
        $this->lancamento->save();
        flash('Lançamento atualizado')->success();
        return redirect()->route('lancamentos.index');
    }
}
