<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Services\UsuarioService;
use Illuminate\Http\Request;

class UsuárioController extends Controller
{
    //

    public function criarUsuario(Request $request){
        $novoUsuario=UsuarioService::criarUsuario($request);
    }

    public function atualizarUsuario(Request $request){
        $usuarioAtualizado=UsuarioService::atualizarUsuario($request);
    }

    public function listarUsuarios(){
        $usuarios=UsuarioService::listarUsuario();
    }

    public function listarUsuarioPorId(Request $request){
        $usuarioAtualizado=UsuarioService::listUsuarioById($request);
    }

    public function deletarUsuario(Request $request){
        $usuarioDeletado=UsuarioService::deleteUsuario($request);
    }
}
