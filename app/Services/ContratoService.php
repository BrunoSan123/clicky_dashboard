<?php
    
namespace App\Services;

use App\Models\Contrato;

class ContratoService{

    public static function criarContrato($data){
        try {
            $numeroDeProtocolo=random_int(100000000000000000, 999999999999999999);
            $novoContrato= Contrato::create([
                'numero_do_contrato'=>$numeroDeProtocolo,
                'nome_do_contratante'=>$data->nome_do_contratante,
                'data_de_inicio'=>$data->data_de_inicio,
                'data_de_termino'=>$data->data_de_termino,
                'valor_do_contrato'=>$data->valor_do_contrato,
                'data_de_emissão'=>$data->data_de_emissão,
                'Empreendimento_id'=>$data->Empreendimento_id
            ]);
            return response()->json('Contrato criado com sucesso, o número de protocolo é: '.$numeroDeProtocolo,200);
        } catch (\Throwable $th) {
            return response()->json('Erro na criação do contrato: '.$th->getMessage(),500);
        }
    }


    public static function atualizarContrato($data){
        try {
           $contratoAtual =Contrato::find($data->id);
           $contratoAtual->update([
            'nome_do_contratante'=>$data->nome_do_contratante,
            'data_de_inicio'=>$data->data_de_inicio,
            'data_de_termino'=>$data->data_de_termino,
            'valor_do_contrato'=>$data->valor_do_contrato,
            'data_de_emissão'=>$data->data_de_emissão
           ]);
           return response()->json('Contrato atualizado com sucesso',200);
        } catch (\Throwable $th) {
            return response()->json('Erro na atualização do contrato: '.$th->getMessage(),500);
        }
    }

    public static function listarContratos(){
        $contratos=Contrato::all();
        return response()->json($contratos,200);
    }

    public static function listarContratoPorId($id){
        try {
            $contratosEspecificos=Contrato::find($id);
            return response()->json($contratosEspecificos,200);
        } catch (\Throwable $th) {
            return response()->json('Usuario não encontrado',404);
        }
    }

    public static function deleteContrato($id){
        try {
            $contratosDeletado=Contrato::find($id);
            $contratosDeletado->delete();
            return response()->json('Contrato deletado com sucesso',200);
        } catch (\Throwable $th) {
            return response()->json('Contrato não achado',404);
        }
    }


}