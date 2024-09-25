<?php
    
namespace App\Services;

use App\Models\Empreendimento;

class EmpreendimentoService{

    public static function criarEmpreendimento($data){
        try {
            $novoEmpreendimento=Empreendimento::create([
                'nome_do_empreendimento'=>$data->nome_do_empreendimento,
                'tipo'=>$data->tipo,
                'codigo'=>'PROTO-' . now()->format('YmdHis'),
                'Usuario_id'=>$data->Usuario_id
    
            ]);
            return response()->json('Emprendimento criado com sucesso! seu número de protocolo:'.'PROTO-' . now()->format('YmdHis'),200);
        } catch (\Throwable $th) {
            return response()->json('erro na criação do empreendimento: '.$th->getMessage(),500);
        }


    }


    public static function atualizarEmpreendimento($data){
        try {
            $empreedimentoExistente=Empreendimento::find($data->id);
            $empreedimentoExistente->update([
                'nome_do_empreendimento'=>$data->nome_do_empreendimento,
                'tipo'=>$data->tipo,
            ]);
            return response()->json('Empreendimento atualizado com sucesso',200);
        } catch (\Throwable $th) {
            return response()->json('Usuario inexistente',500);
        }
    }

    public static function listarEmpreendimentos(){
        $empreendimentos=Empreendimento::all();
        return response()->json($empreendimentos,500);
    }

    public static function listarEmpreendimentoPorId($id){
        try {
           $empreendimentosEspeficos=Empreendimento::find($id);
           return response()->json($empreendimentosEspeficos,200);
        } catch (\Throwable $th) {
            return response()->json('Empreendimento inexistente',404);
        }
    }

    public static function deletarEmpreendimento($id){
        try {
            $empreendimentosDeletados=Empreendimento::find($id);
            return response()->json('Empreendimento deletado com sucesso',200);
        } catch (\Throwable $th) {
            return response()->json('Empreendimento inexistente',500);
        }
    }
}