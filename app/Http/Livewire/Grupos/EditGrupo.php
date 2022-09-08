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

class EditGrupo extends Base
{
    public ?Grupo $grupo     = null;
    public       $nome       = '';
    public       $permission = [];

    protected function rules(): array
    {
        return [
            'nome' => 'required|string|unique:grupos,nome,' . $this->grupo->id
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
        $this->nome = $this->grupo->nome ?? '';
    }

    public function render(): View
    {
        return view('livewire.grupos.edit');
    }

    public function update(): Redirector|RedirectResponse
    {
        $this->validate();

        $this->grupo->nome  = mb_strtoupper($this->nome);
        $this->grupo->save();
        flash('Grupo atualizado')->success();
        return redirect()->route('grupos.index');
    }
}
