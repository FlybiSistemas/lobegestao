<?php

use App\Http\Controllers\Api\ContadorController;
use App\Http\Controllers\Api\EmpresaController;
use App\Http\Controllers\Api\LancamentoController;
use Illuminate\Support\Facades\Route;

Route::post('/lancamentos/{cnpj}', [LancamentoController::class, 'index']);
Route::get('/empresas', [EmpresaController::class, 'index']);
Route::get('/contadores', [ContadorController::class, 'index']);
