<?php

namespace App\Http\Livewire\Lancamentos;

use App\Http\Livewire\Base;
use App\Models\Lancamento;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class DashboardLancamentos extends Base
{
    public    $ano          = null;
    public    $cnpj         = null;
    public    $empresa      = null;
    protected $listeners    = ['refreshDashboardLancamentos' => '$refresh'];
    private   $meses = [];
    private   $anos = [];

    private function montarMeses()
    {
        if (!$this->ano) {
            $this->ano = Carbon::now()->format('Y');
        }
        $this->meses = [];
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

    private function pegarLancamentosNaData(string $tipo, int $ano): Collection
    {
        $query = $this->builder();
        $query = $query->join('empresas as e', 'lancamentos.empresa_id', '=', 'e.id');
        $query = $query->select('lancamentos.*');
        $query = $query->where('lancamentos.tipo', $tipo);
        $primeiroDia = Carbon::createFromFormat("d/m/Y", "01/01/{$ano}");
        $ultimoDia = Carbon::createFromFormat("d/m/Y", "31/12/{$ano}");
        $query = $query->whereBetween('lancamentos.data_lancamento', [$primeiroDia, $ultimoDia]);
        if ($this->cnpj) {
            $query = $query->where("e.cnpj", $this->cnpj);
        }

        return $query->get();
    }

    public function lancamentosIcms()
    {
        $this->montarMeses();
        $dadosDB = $this->pegarLancamentosNaData('M', $this->ano);
        $lancamentos = [];
        // dd($this->meses, $this->ano);
        foreach ($this->meses as $mes) {
            $dadosMes = $dadosDB->where(fn ($item) => $item->data_lancamento->format('Y-m-d') == $mes->format('Y-m-d'))->first();
            // dd($dadosMes);
            $lancamentoMes = [
                "mes"               => $mes->format('m/Y'),
                'data_lancamento'   => $dadosMes ? $dadosMes->data_lancamento->format('m/Y') : $mes->format('m/Y'),
                'valor_apurado'     => $dadosMes ? $dadosMes->valor_apurado : 0,
                'valor_declarado'   => $dadosMes ? $dadosMes->valor_declarado : 0,
                'valor_recolhido'   => $dadosMes ? $dadosMes->valor_recolhido : 0,
                'resultado'         => $dadosMes ? $dadosMes->resultado : 0,
                'tipo'              => 'M',
            ];
            // dd($lancamentoMes, $dadosMes);
            $lancamentos[] = $lancamentoMes;
        }
        // dd($lancamentos);
        return $lancamentos;
    }

    public function lancamentosProtege()
    {
        $dadosDB = $this->pegarLancamentosNaData('P', $this->ano);
        $lancamentos = [];
        foreach ($this->meses as $mes) {
            $dadosMes = $dadosDB->where(fn ($item) => $item->data_lancamento->format('Y-m-d') == $mes->format('Y-m-d'))->first();
            $lancamentoMes = [
                "mes"               => $mes->format('m/Y'),
                'data_lancamento'   => $mes->format('m/Y'),
                'valor_apurado'     => $dadosMes ? $dadosMes->valor_apurado : 0,
                'valor_declarado'   => $dadosMes ? $dadosMes->valor_declarado : 0,
                'valor_recolhido'   => $dadosMes ? $dadosMes->valor_recolhido : 0,
                'resultado'         => $dadosMes ? $dadosMes->resultado : 0,
                'tipo'              => 'M',
            ];
            $lancamentos[] = $lancamentoMes;
        }
        // dd($lancamentos);
        return $lancamentos;
    }

    public function lancamentosIpi()
    {
        $dadosDB = $this->pegarLancamentosNaData('I', $this->ano);
        $lancamentos = [];
        foreach ($this->meses as $mes) {
            $dadosMes = $dadosDB->where(fn ($item) => $item->data_lancamento->format('Y-m-d') == $mes->format('Y-m-d'))->first();
            $lancamentoMes = [
                "mes"               => $mes->format('m/Y'),
                'data_lancamento'   => $mes->format('m/Y'),
                'valor_apurado'     => $dadosMes ? $dadosMes->valor_apurado : 0,
                'valor_declarado'   => $dadosMes ? $dadosMes->valor_declarado : 0,
                'valor_recolhido'   => $dadosMes ? $dadosMes->valor_recolhido : 0,
                'resultado'         => $dadosMes ? $dadosMes->resultado : 0,
                'tipo'              => 'M',
            ];
            $lancamentos[] = $lancamentoMes;
        }
        // dd($lancamentos);
        return $lancamentos;
    }

    public function lancamentosPis()
    {
        $dadosDB = $this->pegarLancamentosNaData('S', $this->ano);
        $lancamentos = [];
        foreach ($this->meses as $mes) {
            $dadosMes = $dadosDB->where(fn ($item) => $item->data_lancamento->format('Y-m-d') == $mes->format('Y-m-d'))->first();
            $lancamentoMes = [
                "mes"               => $mes->format('m/Y'),
                'data_lancamento'   => $mes->format('m/Y'),
                'valor_apurado'     => $dadosMes ? $dadosMes->valor_apurado : 0,
                'valor_declarado'   => $dadosMes ? $dadosMes->valor_declarado : 0,
                'valor_recolhido'   => $dadosMes ? $dadosMes->valor_recolhido : 0,
                'resultado'         => $dadosMes ? $dadosMes->resultado : 0,
                'tipo'              => 'M',
            ];
            $lancamentos[] = $lancamentoMes;
        }
        // dd($lancamentos);
        return $lancamentos;
    }

    public function lancamentosCofins()
    {
        $dadosDB = $this->pegarLancamentosNaData('C', $this->ano);
        $lancamentos = [];
        foreach ($this->meses as $mes) {
            $dadosMes = $dadosDB->where(fn ($item) => $item->data_lancamento->format('Y-m-d') == $mes->format('Y-m-d'))->first();
            $lancamentoMes = [
                "mes"               => $mes->format('m/Y'),
                'data_lancamento'   => $mes->format('m/Y'),
                'valor_apurado'     => $dadosMes ? $dadosMes->valor_apurado : 0,
                'valor_declarado'   => $dadosMes ? $dadosMes->valor_declarado : 0,
                'valor_recolhido'   => $dadosMes ? $dadosMes->valor_recolhido : 0,
                'resultado'         => $dadosMes ? $dadosMes->resultado : 0,
                'tipo'              => 'M',
            ];
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
