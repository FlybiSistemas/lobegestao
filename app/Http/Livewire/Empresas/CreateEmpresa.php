<?php

declare(strict_types=1);

namespace App\Http\Livewire\Empresas;

use App\Http\Livewire\Base;
use App\Models\Empresa;
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

    protected array $rules = [
        'nome' => 'required|string|unique:empresas,nome'
    ];

    protected array $messages = [
        'nome.required' => 'O Nome é obrigatório'
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
        return view('livewire.empresas.create');
    }

    public function store(): Redirector|RedirectResponse
    {
        $this->validate();
        $empresa = Empresa::create([
            'nome'  => mb_strtoupper($this->nome)
        ]);
        flash('Empresa criado')->success();
        return redirect()->route('empresas.index');
    }

    public function cancel(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
}
