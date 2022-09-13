<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contador;
use Illuminate\Http\Request;

class ContadorController extends Controller
{
    public function index(Request $request)
    {
        $contadores = Contador::all();
        $retorno = [];
        foreach ($contadores as $contador) {
            $retorno[] = [
                "id" => $contador->id,
                "nome" => $contador->nome,
                'usuario' => $contador->usuario,
                'senha' => $contador->senha,
            ];
        }

        return response()->json($retorno, 200);
    }
}
