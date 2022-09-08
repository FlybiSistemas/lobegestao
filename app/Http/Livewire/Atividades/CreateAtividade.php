<?php

declare(strict_types=1);

namespace App\Http\Livewire\Atividades;

use App\Http\Livewire\Base;
use App\Models\Atividade;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;

use function flash;
use function redirect;
use function view;

class CreateAtividade extends Base
{
    public $nome = '';

    protected array $rules = [
        'nome' => 'required|string|unique:atividades,nome'
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
        return view('livewire.atividades.create');
    }

    public function store(): Redirector|RedirectResponse
    {
        $this->validate();
        $atividade = Atividade::create([
            'nome'  => mb_strtoupper($this->nome)
        ]);
        flash('Atividade criado')->success();
        return redirect()->route('atividades.index');
    }

    public function cancel(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
}
