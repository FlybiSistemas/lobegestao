<?php

namespace App\Http\Livewire\Contadores;

use App\Exports\ContadoresExport;
use App\Http\Livewire\Base;
use App\Models\Contador;
use Livewire\WithPagination;

class Contadores extends Base
{
    use WithPagination;
    public    $paginate   = 10;
    public    $checked    = [];
    public    $nome       = '';
    public    $sortField  = 'nome';
    public    $sortAsc    = true;
    public    $openFilter = false;
    public    $sentEmail  = false;
    protected $listeners  = ['refreshContadores' => '$refresh'];

    public function render()
    {
        return view('livewire.contadores.index');
    }
    public function builder()
    {
        return Contador::orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
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

    public function contadores()
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

    public function deleteDepartamento($id): void
    {
        $this->builder()->findOrFail($id)->delete();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function exportar()
    {
        return (new ContadoresExport())->download('contadores.csv');
    }
}
