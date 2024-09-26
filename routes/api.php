<?php

use App\Http\Controllers\ContratoController;
use App\Http\Controllers\EmpreendimentoController;
use App\Http\Controllers\UsuárioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/teste', function () {
    return response()->json(['message' => 'Test api']);
});


//rotas para inserção

Route::post('/criar_usuario',[UsuárioController::class,'criarUsuario']);
Route::post('/criar_empreendimento',[EmpreendimentoController::class,'criarEmpreendimento']);
Route::post('/criar_contrato',[ContratoController::class,'criarContrato']);


// rotas para atualização

Route::put('/atualizar_usuario',[UsuárioController::class,'atualizarUsuario']);
Route::put('/atualiza_empreendimento',[EmpreendimentoController::class,'atualizaEmpreendimento']);
Route::put('/atualizar_contrato',[ContratoController::class,'atualizarContrato']);

//rotas para exibição

Route::get('/listar_usuario',[UsuárioController::class,'listarUsuarios']);
Route::get('/listar_empreendimento',[EmpreendimentoController::class,'listarEmpreendimentos']);
Route::get('/listar_contratos',[ContratoController::class,'listarContratos']);

// rotas para exibição por id

Route::get('/listar_usuario/{id}',[UsuárioController::class,'listarUsuarioPorId']);
Route::get('/listar_empreendimento/{id}',[EmpreendimentoController::class,'listarEmpreendimentoPorId']);
Route::get('/listar_contrato/{id}',[ContratoController::class,'listarContratoPorId']);


//rotas de deleção
Route::delete('/deletar_usuario/{id}',[UsuárioController::class,'deletarUsuario']);
Route::delete('/deletar_empreendimento/{id}',[EmpreendimentoController::class,'deletarEmpreeendimento']);
Route::delete('/deletar_empreendimento/{id}',[ContratoController::class,'deletarContrato']);


