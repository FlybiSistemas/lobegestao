<?php

namespace App\Http\Livewire\Lancamentos;

use App\Http\Livewire\Base;
use App\Models\Lancamento;
use Livewire\WithPagination;

class Lancamentos extends Base
{
    use WithPagination;
    public    $paginate         = 10;
    public    $checked          = [];
    public    $nome             = '';
    public    $data_lancamento  = '';
    public    $sortField        = 'data_lancamento';
    public    $sortAsc          = true;
    public    $openFilter       = false;
    public    $sentEmail        = false;
    protected $listeners        = ['refreshLancamentos' => '$refresh'];

    public function render()
    {
        return view('livewire.lancamentos.index');
    }

    public function builder()
    {
        return Lancamento::orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
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

    public function lancamentos()
    {
        $query = $this->builder();
        if ($this->nome) {
            $query->where('nome', 'like', '%' . $this->nome . '%');
        }
        if ($this->data_lancamento) {
            $query->where('data_lancamento', '=', $this->data_lancamento);
        }

        return $query->paginate($this->paginate);
    }

    public function resetFilters(): void
    {
        $this->reset();
    }

    public function deleteLancamento($id): void
    {
        $this->builder()->findOrFail($id)->delete();
        $this->dispatchBrowserEvent('close-modal');
    }
}
