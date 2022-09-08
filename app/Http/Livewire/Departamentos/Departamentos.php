<?php

namespace App\Http\Livewire\Departamentos;

use App\Http\Livewire\Base;
use App\Models\Departamento;
use Livewire\WithPagination;

class Departamentos extends Base
{
    use WithPagination;
    public    $paginate   = '';
    public    $checked    = [];
    public    $nome       = '';
    public    $sortField  = 'nome';
    public    $sortAsc    = true;
    public    $openFilter = false;
    public    $sentEmail  = false;
    protected $listeners  = ['refreshDepartamentos' => '$refresh'];

    public function render()
    {
        return view('livewire.departamentos.index');
    }
    public function builder()
    {
        return Departamento::orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
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

    public function departamentos()
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
}
