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

class EditAtividade extends Base
{
    public ?Atividade $atividade     = null;
    public       $nome       = '';

    protected function rules(): array
    {
        return [
            'nome' => 'required|string|unique:atividades,nome,' . $this->atividade->id
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
        $this->nome = $this->atividade->nome ?? '';
    }

    public function render(): View
    {
        return view('livewire.atividades.edit');
    }

    public function update(): Redirector|RedirectResponse
    {
        $this->validate();

        $this->atividade->nome  = mb_strtoupper($this->nome);
        $this->atividade->save();
        flash('Atividade atualizado')->success();
        return redirect()->route('atividades.index');
    }
}
