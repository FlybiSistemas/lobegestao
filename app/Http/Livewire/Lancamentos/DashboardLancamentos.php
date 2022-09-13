<?php

namespace App\Http\Livewire\Lancamentos;

use App\Http\Livewire\Base;
use App\Models\Lancamento;
use Carbon\Carbon;

class DashboardLancamentos extends Base
{
    public    $ano          = null;
    public    $empresa      = null;
    protected $listeners    = ['refreshDashboardLancamentos' => '$refresh'];
    private   $meses = [];

    public function mount()
    {
        $this->ano = Carbon::now()->format('Y');
        for ($i = 1; $i <= 12; $i++) {
            $this->meses[] = Carbon::now()->createFromFormat("d/m/Y", "01/{$i}/{$this->ano}");
        }
    }

    public function render()
    {
        return view('livewire.lancamentos.dashboard', [
            'meses' => $this->meses
        ]);
    }

    public function builder()
    {
        return Lancamento::orderBy("data_lancamento", 'asc');
    }

    public function lancamentosIcms()
    {
        $query = $this->builder();
        $query = $query->where('tipo', 'M');
        if ($this->ano) {
            $primeiroDia = Carbon::createFromFormat("d/m/Y", "01/01/{$this->ano}");
            $ultimoDia = Carbon::createFromFormat("d/m/Y", "31/12/{$this->ano}");
            $query->whereBetween('data_lancamento', [$primeiroDia, $ultimoDia]);
        }

        $dadosDB = $query->get();
        $lancamentos = [];
        foreach ($this->meses as $mes) {
            $dadosMes = $dadosDB->where(fn ($item) => $item->data_lancamento->format('Y-m-d') == $mes->format('Y-m-d'))->first();
            if ($dadosMes) {
                $lancamentoMes = [
                    "mes" => "{$mes->format('m/Y')}",
                    'data_lancamento'   => $dadosMes->data_lancamento,
                    'valor_apurado'     => $dadosMes->valor_apurado,
                    'valor_declarado'   => $dadosMes->valor_declardado,
                    'valor_recolhido'   => $dadosMes->valor_recolhido,
                    'resultado'         => $dadosMes->resultado,
                    'tipo'              => 'M',
                ];
                // $lancamentoMes += $dadosMes;
            } else {
                $lancamentoMes = [
                    "mes"               => $mes->format('m/Y'),
                    'data_lancamento'   => $mes->format('m/Y'),
                    'valor_apurado'     => 0,
                    'valor_declarado'   => 0,
                    'valor_recolhido'   => 0,
                    'resultado'         => 0,
                    'tipo'              => 'M',
                ];
            }
            $lancamentos[] = $lancamentoMes;
        }
        // dd($lancamentos);
        return $lancamentos;
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
