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

class CreateLancamento extends Base
{
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

    public function render(): View
    {
        return view('livewire.lancamentos.create');
    }

    public function store(): Redirector|RedirectResponse
    {
        $this->validate();
        $lancamento = Lancamento::create([
            'data_lancamento' => $this->data_lancamento ? Carbon::createFromFormat("d/m/Y", $this->data_lancamento) : null,
            'valor_apurado' => $this->valor_apurado,
            'valor_declarado' => $this->valor_declarado,
            'valor_recolhido' => $this->valor_recolhido,
            'resultado' => $this->resultado,
            'tipo' => $this->tipo
        ]);
        flash('Lançamento criado')->success();
        return redirect()->route('lancamentos.index');
    }

    public function cancel(): void
    {
        $this->reset();
    }
}
