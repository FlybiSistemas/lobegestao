<?php

namespace App\Http\Livewire\Empresas;

use App\Http\Livewire\Base;
use App\Models\Empresa;
use Illuminate\Contracts\View\View;

use function abort;
use function cannot;
use function view;

class ShowEmpresa extends Base
{
    public Empresa $empresa;

    public function render(): View
    {
        return view('livewire.empresas.show');
    }
}
