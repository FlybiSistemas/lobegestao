<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Lancamento;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LancamentoController extends Controller
{
    public function index(Request $request, $cnpj)
    {
        if (!$cnpj) {
            return response()->json(["message" => "Nenhum número de documento informado!"], 400);
        }
        if (strlen($cnpj) != 14) {
            return response()->json(["message" => "Número de documento inválido!"], 400);
        }
        $dados = $request->all();
        $empresa = Empresa::where('cnpj', $cnpj)->first();
        $lancamento = [
            "empresa_id" => $empresa->id,
            "data_lancamento" => Carbon::createFromFormat("d/m/Y", "01/" . $dados['data_lancamento']),
            "valor_apurado" => $dados['valor_apurado'],
            "valor_declarado" => $dados['valor_declarado'],
            "valor_recolhido" => $dados['valor_recolhido'],
            "resultado" => $dados['valor_declarado'] - $dados['valor_recolhido'],
            "tipo" => $dados['tipo'],
        ];

        $valores = array_filter($lancamento, function ($value) {
            return $value !== null;
        });

        $lancamento = Lancamento::updateOrCreate(
            ['empresa_id' => $lancamento['empresa_id'],
            'data_lancamento' => $lancamento['data_lancamento']->format('Y-m-d'),
            'tipo' => $lancamento['tipo']
        ], $valores);
        
        return response()->json($lancamento, 200);
    }
}
