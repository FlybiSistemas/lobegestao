<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;

class SpedController extends Controller
{
    public function index(Request $request)
    {
        $tipo = $request->input("tipo");
        if($tipo == 'icms'){
            $empresas = Empresa::where('bot_icms', true)->select('cnpj')->get();
        }
        else if($tipo == 'piscofins'){
            $empresas = Empresa::where('bot_pis_cofins', true)->select('cnpj')->get();
        }

        $retorno = array_map(function($empresa){
            return array_values($empresa);
        }, $empresas->toArray());

        return response()->json($retorno, 200);
    }
}
