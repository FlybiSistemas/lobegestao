<?php

declare(strict_types=1);

namespace App\Http\Livewire\Contadores;

use App\Http\Livewire\Base;
use App\Models\Contador;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;

use function flash;
use function redirect;
use function view;

class CreateContador extends Base
{
    public $nome       = '';
    public $usuario    = '';
    public $senha      = '';

    protected array $rules = [
        'nome'      => 'required|string|unique:contadores,nome',
        'usuario'   => 'required',
        'senha'     => 'required',
    ];

    protected array $messages = [
        'nome.required' => 'O Nome é obrigatório',
        'usuario.required' => 'O Usuário é obrigatório',
        'senha.required' => 'A Senha é obrigatória',
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
        return view('livewire.contadores.create');
    }

    public function store(): Redirector|RedirectResponse
    {
        $this->validate();
        $contador = Contador::create([
            'nome'      => mb_strtoupper($this->nome),
            'usuario'   => $this->usuario,
            'senha'     => $this->senha,
        ]);
        flash('Contador criado')->success();
        return redirect()->route('contadores.index');
    }

    public function cancel(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
}
