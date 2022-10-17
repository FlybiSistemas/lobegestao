<?php

namespace App\Http\Livewire\Empresas;

use App\Exports\EmpresasExport;
use App\Http\Livewire\Base;
use App\Models\Empresa;
use Livewire\WithPagination;

class Empresas extends Base
{
    use WithPagination;
    public    $paginate   = 10;
    public    $checked    = [];
    public    $nome       = '';
    public    $sortField  = 'nome';
    public    $sortAsc    = true;
    public    $openFilter = false;
    public    $sentEmail  = false;
    protected $listeners  = ['refreshEmpresas' => '$refresh'];

    public function render()
    {
        return view('livewire.empresas.index');
    }
    public function builder()
    {
        return Empresa::orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
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

    public function empresas()
    {
        $query = $this->builder()
            ->join('grupos as g', 'g.id', '=', 'empresas.grupo_id', 'left')
            ->join('departamentos as d', 'd.id', '=', 'empresas.departamento_id', 'left')
            ->join('atividades as at', 'at.id', '=', 'empresas.atividade_id', 'left')
            ->select('empresas.*');
        if ($this->nome) {
            $query->where('empresas.nome', 'like', '%' . $this->nome . '%');
            $query->orWhere('g.nome', 'like', '%' . $this->nome . '%');
            $query->orWhere('d.nome', 'like', '%' . $this->nome . '%');
            $query->orWhere('at.nome', 'like', '%' . $this->nome . '%');
            $query->orWhere('empresas.cnpj', 'like', $this->nome . '%');
        }

        return $query->paginate($this->paginate);
    }

    public function resetFilters(): void
    {
        $this->reset();
    }

    public function deleteEmpresa($id): void
    {
        $this->builder()->findOrFail($id)->delete();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function exportar()
    {
        return (new EmpresasExport)->download('empresas.csv');
    }
}
