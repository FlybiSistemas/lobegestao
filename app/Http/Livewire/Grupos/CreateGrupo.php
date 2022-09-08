<?php

declare(strict_types=1);

namespace App\Http\Livewire\Grupos;

use App\Http\Livewire\Base;
use App\Models\Grupo;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;

use function flash;
use function redirect;
use function view;

class CreateGrupo extends Base
{
    public $nome = '';

    protected array $rules = [
        'nome' => 'required|string|unique:grupos,nome'
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
        return view('livewire.grupos.create');
    }

    public function store(): Redirector|RedirectResponse
    {
        $this->validate();
        $grupo = Grupo::create([
            'nome'  => mb_strtoupper($this->nome)
        ]);
        flash('Grupo criado')->success();
        return redirect()->route('grupos.index');
    }

    public function cancel(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
}
