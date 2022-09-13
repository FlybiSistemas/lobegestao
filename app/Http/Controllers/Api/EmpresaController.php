<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index(Request $request)
    {
        $cnpj = $request->input("cnpj");
        $empresas = Empresa::with('contador')->where('cnpj', $cnpj)->get();
        $retorno = [];
        foreach ($empresas as $empresa) {
            $retorno[] = [
                "id" => $empresa->id,
                "cnpj" => $empresa->cnpj,
                'contador' => $empresa->contador ? $empresa->contador->nome : null,
                'contador_usuario' => $empresa->contador ? $empresa->contador->usuario : null,
                'contador_senha' => $empresa->contador ? $empresa->contador->senha : null,
            ];
        }

        return response()->json($retorno, 200);
    }
}
