<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contador extends Model
{

    public $table = 'contadores';

    protected $guarded = [];
    public array $searchable = ['nome'];
    public string $label     = 'nome';
    public string $section   = 'Contador';

    public function route($id): string
    {
        return route('contadores.show', ['contador' => $id]);
    }

    public function empresas()
    {
        return $this->hasMany(Empresa::class, 'contador_id');
    }
}
