<?php
    
namespace App\Services;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioService{

    public static function criarUsuario($data){
        try {
            $novoUsuario=Usuario::create([
                'nome'=>$data->nome,
                'sobrenome'=>$data->sobrenome,
                'senha'=>Hash::make($data->senha),
                'email'=>$data->email,
                'tipo'=>$data->tipo
    
            ]);
            return response()->json('Usuario criado com sucesso',200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json('Erro na criação do usuario: '.$th->getMessage(),500);

        }

        
    }

    public static function atualizarUsuario($data){
       try {
        $usuarioAtual=Usuario::find($data->id);
        $usuarioAtual->update([
            'nome' => $data->nome,
            'sobrenome' => $data->sobrenome,
            'senha' => Hash::make($data->senha), // Caso a senha seja alterada
            'email' => $data->email,
            'tipo' => $data->tipo
        ]);
            return response()->json('usuario atualizado com sucesso',200);
       } catch (\Throwable $th) {
            return response()->json('Erro na atualização do usuario: '.$th->getMessage(),500);
       }

    }

    public static function listarUsuario(){
        $usuarios=Usuario::all();
        return response()->json($usuarios,200);
    }

    public static function listUsuarioById($id){
        try {
            $usuarioEspecifico=Usuario::find($id);
            return response()->json($usuarioEspecifico,200);
        } catch (\Throwable $th) {
            return response()->json('Usuário inexistente',500);
        }
    }


    public static function deleteUsuario($id){
        try {
            $usuario=Usuario::find($id);
            $usuario->delete();
            return response()->json('Usuario deletado com sucesso',200);
        } catch (\Throwable $th) {
            return response()->json('Usuario inexistente',500);
        }
    }
}