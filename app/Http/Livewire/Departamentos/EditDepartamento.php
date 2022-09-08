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

class EditDepartamento extends Base
{
    public ?Departamento $departamento     = null;
    public       $nome       = '';

    protected function rules(): array
    {
        return [
            'nome' => 'required|string|unique:departamentos,nome,' . $this->departamento->id
        ];
    }

    protected array $messages = [
        'nome.required' => 'O nome é obrigatório'
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
        $this->nome = $this->departamento->nome ?? '';
    }

    public function render(): View
    {
        return view('livewire.departamentos.edit');
    }

    public function update(): Redirector|RedirectResponse
    {
        $this->validate();

        $this->departamento->nome  = mb_strtoupper($this->nome);
        $this->departamento->save();
        flash('Departamento atualizado')->success();
        return redirect()->route('departamentos.index');
    }
}
