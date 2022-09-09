<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Base;
use App\Models\Empresa;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;

class Dashboard extends Base
{

    public $semana    = [];
    public $mes       = [];
    public $trimestre = [];

    public function mount()
    {
        $dataAviso = Carbon::now()->addMonths(3);
        $query = Empresa::orderBy('certificado_validade', 'asc');
        $query->where('certificado_validade', '<', $dataAviso->format('Y-m-d'));
        $query->where('certificado_validade', '>=', Carbon::now()->format('Y-m-d'));
        $dados = $query->get();

        $this->semana = $dados->where('certificado_validade', '<', Carbon::now()->addDays(7)->format('Y-m-d'));
        $this->mes = $dados->where('certificado_validade', '<', Carbon::now()->addMonth()->format('Y-m-d'))
            ->where('certificado_validade', '>', Carbon::now()->addDays(7)->format('Y-m-d'));
        $this->mes = $dados->where('certificado_validade', '>', Carbon::now()->addMonth()->format('Y-m-d'))
            ->where('certificado_validade', '<', $dataAviso->format('Y-m-d'));
    }

    public function render(): View
    {
        $empresas = Empresa::query()
            ->join('grupos as g', 'g.id', '=', 'empresas.grupo_id', 'left')
            ->join('departamentos as d', 'd.id', '=', 'empresas.departamento_id', 'left')
            ->join('atividades as at', 'at.id', '=', 'empresas.atividade_id', 'left')
            ->select('empresas.*', 'g.nome as nome_grupo', 'd.nome as nome_departamento', 'at.nome as nome_atividade')
            ->get();
        $empresasPorAtividades = $empresas->groupBy('nome_atividade');
        $empresasPorDepartamento = $empresas->groupBy('nome_departamento');
        return view('livewire.admin.dashboard', [
            'empresasPorAtividades' => $empresasPorAtividades,
            'empresasPorDepartamento' => $empresasPorDepartamento
        ]);
    }
}
