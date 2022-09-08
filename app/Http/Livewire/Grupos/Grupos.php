<?php

namespace App\Http\Livewire\Grupos;

use App\Http\Livewire\Base;
use App\Models\Grupo;
use Livewire\WithPagination;

class Grupos extends Base
{
    use WithPagination;
    public    $paginate   = '';
    public    $checked    = [];
    public    $nome       = '';
    public    $sortField  = 'nome';
    public    $sortAsc    = true;
    public    $openFilter = false;
    public    $sentEmail  = false;
    protected $listeners  = ['refreshGrupos' => '$refresh'];

    public function render()
    {
        return view('livewire.grupos.index');
    }
    public function builder()
    {
        return Grupo::orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
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

    public function grupos()
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
