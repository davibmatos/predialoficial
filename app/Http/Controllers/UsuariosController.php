<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $senha = $request->senha;

        $usuarios = usuario::where('email', '=', $email)->where('senha', '=', $senha)->first();

        if (@$usuarios->id != null) {
            @session_start();
            $_SESSION['id_usuario'] = $usuarios->id;
            $_SESSION['nome_usuario'] = $usuarios->nome;
            $_SESSION['nivel_usuario'] = $usuarios->nivel;
            $_SESSION['cpf_usuario'] = $usuarios->cpf;

            if ($_SESSION['nivel_usuario'] == 'admin') {
                return redirect()->route('admin.index');
            }
            if ($_SESSION['nivel_usuario'] == 'sindico') {
                return view('painel-sindico.index');
            }
            if ($_SESSION['nivel_usuario'] == 'usuario') {
                return view('painel-user.index');
            }
        } else {
            echo "<script language='javascript'> window.alert('Dados Incorretos!') </script>";
            return view('index');
        }
    }
    public function logout()
    {
        @session_start();
        @session_destroy();
        return view('index');
    }
}
