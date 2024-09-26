<?php

namespace App\Http\Controllers;

use App\Models\Empreendimento;
use App\Services\EmpreendimentoService;
use Illuminate\Http\Request;

class EmpreendimentoController extends Controller
{
    //

    public function criarEmpreendimento(Request $request){
        $novoEmpreendimento=EmpreendimentoService::criarEmpreendimento($request);

    }

    public function atualizaEmpreendimento(Request $request){
        $empreendimentoAtualizado=EmpreendimentoService::atualizarEmpreendimento($request);
    }

    public function listarEmpreendimentos(){
        $empreendimentos=EmpreendimentoService::listarEmpreendimentos();
    }
    public function listarEmpreendimentoPorId(Request $request){
        $usuarioEspecifico=EmpreendimentoService::listarEmpreendimentoPorId($request);
    }

    public function deletarEmpreeendimento(Request $request){
        $uduarioDeletado=EmpreendimentoService::deletarEmpreendimento($request);
    }
}
