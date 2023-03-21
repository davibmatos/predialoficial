<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\usuario;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('painel-adm.index');
    }

    public function editar(Request $request, usuario $usuario){
        
        $usuario->nome = $request->nome;
        $usuario->cpf = $request->cpf;
        $usuario->email = $request->email;
        $usuario->senha = $request->senha;
        $usuario->save();
        return redirect()->route('admin.index');

    }
}

