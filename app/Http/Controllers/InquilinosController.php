<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\inquilino;
use App\Models\sindico;
use App\Models\usuario;
use Illuminate\Http\Request;

class InquilinosController extends Controller
{
    public function index()
    {
        $tabela = inquilino::orderBy('id', 'desc')->paginate();
        return view('painel-adm.inquilinos.index', ['itens' => $tabela]);
    }

    public function create()
    {
        return view('painel-adm.inquilinos.create');
    }

    public function insert(Request $request)
    {
        
        $tabela = new inquilino();
        $tabela->nome = $request->nome;
        $tabela->email = $request->email;
        $tabela->cpf = $request->cpf;
        $tabela->telefone = $request->telefone;

        $tabela2 = new usuario();
        $tabela2->nome = $request->nome;
        $tabela2->email = $request->email;
        $tabela2->cpf = $request->cpf;
        $tabela2->telefone = $request->telefone;
        $tabela2->senha = $request->cpf;
        $tabela2->nivel = 'inquilino';

        $itens = inquilino::where('cpf', '=', $request->cpf)->orwhere('email', '=', $request->email)->first();

        if ($itens !== null) {
            echo "<script language='javascript'> window.alert('O Síndico cadastrado já existe') </script>";
            return view('painel-adm.inquilinos.create');
        }

        $tabela->save();
        $tabela2->save();
        return redirect()->route('inquilinos.index');
    }

    public function edit(inquilino $item){
        return view('painel-adm.inquilinos.edit', ['item' => $item]);   
     }
 
 
     public function editar(Request $request, inquilino $item){
         
        $item->nome = $request->nome;
        $item->email = $request->email;
        $item->cpf = $request->cpf;
        $item->telefone = $request->telefone;
       

        $oldcpf = $request->oldcpf;
        $oldemail = $request->oldemail;

        if($oldcpf != $request->cpf){
            $itens = inquilino::where('cpf', '=', $request->cpf)->count();
            if($itens > 0){
                echo "<script language='javascript'> window.alert('CPF já Cadastrado!') </script>";
                return view('painel-adm.inquilinos.edit', ['item' => $item]);   
                
            }
        }

        if($oldemail != $request->email){
            $itens = inquilino::where('email', '=', $request->email)->count();
            if($itens > 0){
                echo "<script language='javascript'> window.alert('Email já Cadastrado!') </script>";
                return view('painel-adm.inquilinos.edit', ['item' => $item]);   
                
            }
        }     

        $item->save();
         return redirect()->route('inquilinos.index');
 
     }

     public function delete(inquilino $item){
        $item->delete();
        return redirect()->route('inquilinos.index');
     }

     public function modal($id){
        $item = inquilino::orderby('id', 'desc')->paginate();
        return view('painel-adm.inquilinos.index', ['itens' => $item, 'id' => $id]);
     } 
}
