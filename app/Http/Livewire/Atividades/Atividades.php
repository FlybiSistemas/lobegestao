<?php

namespace App\Http\Livewire\Atividades;

use App\Http\Livewire\Base;
use App\Models\Atividade;
use Livewire\WithPagination;

class Atividades extends Base
{
    use WithPagination;
    public    $paginate   = 10;
    public    $checked    = [];
    public    $nome       = '';
    public    $sortField  = 'nome';
    public    $sortAsc    = true;
    public    $openFilter = false;
    public    $sentEmail  = false;
    protected $listeners  = ['refreshAtividades' => '$refresh'];

    public function render()
    {
        return view('livewire.atividades.index');
    }
    public function builder()
    {
        return Atividade::orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function atividades()
    {
        $query = $this->builder();

        if ($this->nome) {
            $query->where('nome', 'like', '%' . $this->nome . '%');
        }

        return $query->paginate($this->paginate);
    }

    public function resetFilters(): void
    {
        $this->reset();
    }

    public function deleteGrupo($id): void
    {
        $this->builder()->findOrFail($id)->delete();
        $this->dispatchBrowserEvent('close-modal');
    }
}
