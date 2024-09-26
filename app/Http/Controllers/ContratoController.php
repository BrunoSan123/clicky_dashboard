<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContratoService;

class ContratoController extends Controller
{
    //
    public function criarContrato(Request $request){
        $novoContrato=ContratoService::criarContrato($request);
    }

    public function atualizarContrato(Request $request){
        $contratoAtualizado=ContratoService::atualizarContrato($request);
    }

    public function listarContratos(){
        $contratos=ContratoService::listarContratos();
    }

    public function listarContratoPorId(Request $request){
        $contratoEspecifico=ContratoService::listarContratoPorId($request);
    }

    public function deletarContrato(Request $request){
        $contratoDeletado=ContratoService::deleteContrato($request);
    }
}
