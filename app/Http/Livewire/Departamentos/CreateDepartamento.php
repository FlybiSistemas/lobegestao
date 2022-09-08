<?php

declare(strict_types=1);

namespace App\Http\Livewire\Departamentos;

use App\Http\Livewire\Base;
use App\Models\Departamento;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;

use function flash;
use function redirect;
use function view;

class CreateDepartamento extends Base
{
    public $nome = '';

    protected array $rules = [
        'nome' => 'required|string|unique:departamentos,nome'
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
        return view('livewire.departamentos.create');
    }

    public function store(): Redirector|RedirectResponse
    {
        $this->validate();
        $departamento = Departamento::create([
            'nome'  => mb_strtoupper($this->nome)
        ]);
        flash('Departamento criado')->success();
        return redirect()->route('departamentos.index');
    }

    public function cancel(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
}
