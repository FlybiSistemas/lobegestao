<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lancamento extends Model
{
    protected $dates = ['data_lancamento'];
    public $table = 'lancamentos';

    public $fillable = [
        'empresa_id',
        'data_lancamento',
        'valor_apurado',
        'valor_recolhido',
        'valor_declarado',
        'resultado',
        'tipo'
    ];

    protected $casts = [
        'empresa_id'        => 'integer',
        'valor_apurado'     => 'decimal:2',
        'valor_recolhido'   => 'decimal:2',
        'valor_declarado'   => 'decimal:2',
        'resultado'         => 'decimal:2',
        'tipo'              => 'string',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function tipoLancamento()
    {
        if ($this->tipo == "M") {
            return "ICMS";
        }
        if ($this->tipo == "I") {
            return "IPI";
        }
        if ($this->tipo == "P") {
            return "PROTEGE";
        }
        return "PIS/COFINS";
    }
}
