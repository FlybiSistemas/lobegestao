<?php

declare(strict_types=1);

namespace App\Http\Livewire\Contadores;

use App\Http\Livewire\Base;
use App\Models\Contador;
use App\Models\Departamento;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;

use function flash;
use function redirect;
use function view;

class EditContador extends Base
{
    public ?Contador $contador = null;
    public  $nome       = '';
    public  $usuario    = '';
    public  $senha      = '';

    protected function rules(): array
    {
        return [
            'nome' => 'required|string|unique:contadores,nome,' . $this->contador->id,
            'usuario'   => 'required',
            'senha'     => 'required',
        ];
    }

    protected array $messages = [
        'nome.required' => 'O nome é obrigatório',
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

    public function mount(): void
    {
        $this->nome = $this->contador->nome ?? '';
        $this->usuario = $this->contador->usuario ?? '';
        $this->senha = $this->contador->senha ?? '';
    }

    public function render(): View
    {
        return view('livewire.contadores.edit');
    }

    public function update(): Redirector|RedirectResponse
    {
        $this->validate();

        $this->contador->nome       = mb_strtoupper($this->nome);
        $this->contador->usuario    = $this->usuario;
        $this->contador->senha      = $this->senha;
        $this->contador->save();
        flash('Contador atualizado')->success();
        return redirect()->route('contadores.index');
    }
}
