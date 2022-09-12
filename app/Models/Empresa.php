<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $guarded = [];
    protected $dates = ['certificado_validade', 'data_abertura', 'cliente_desde', 'cliente_ate'];
    public array $searchable = ['empresas.nome', 'empresas.cnpj', 'empresas.fantasia'];
    public string $label     = 'nome';
    public string $section   = 'Empresa';

    public function route($id): string
    {
        return route('empresas.show', ['empresa' => $id]);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function atividade()
    {
        return $this->belongsTo(Atividade::class);
    }

    public function contador()
    {
        return $this->belongsTo(Contador::class);
    }

    public function nomeRegimeTributario()
    {
        if ($this->regime_tributario == "S") {
            return "SIMPLES";
        }
        if ($this->regime_tributario == "R") {
            return "LUCRO REAL";
        }
        return "LUCRO PRESUMIDO";
    }

    public function nomePeriodoApuracao()
    {
        if ($this->periodo_apuracao == "S") {
            return "SEMANAL";
        }
        if ($this->periodo_apuracao == "M") {
            return "MENSAL";
        }
        if ($this->periodo_apuracao == "T") {
            return "TRIMESTRAL";
        }
        return "ANUAL";
    }
}
