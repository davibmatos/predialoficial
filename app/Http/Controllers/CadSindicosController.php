<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\sindico;
use App\Models\usuario;
use Illuminate\Http\Request;

class CadSindicosController extends Controller
{
    public function index()
    {
        $tabela = Sindico::orderBy('id', 'desc')->paginate();
        return view('painel-adm.sindicos.index', ['itens' => $tabela]);
    }

    public function create()
    {
        return view('painel-adm.sindicos.create');
    }

    public function insert(Request $request)
    {
        
        $tabela = new Sindico();
        $tabela->nome = $request->nome;
        $tabela->email = $request->email;
        $tabela->cpf = $request->cpf;
        $tabela->telefone = $request->telefone;
        $tabela->credencial = $request->credencial;
        $tabela->data = $request->data;

        $tabela2 = new usuario();
        $tabela2->nome = $request->nome;
        $tabela2->email = $request->email;
        $tabela2->cpf = $request->cpf;
        $tabela2->telefone = $request->telefone;
        $tabela2->senha = $request->cpf;
        $tabela2->nivel = 'sindico';

        $itens = sindico::where('cpf', '=', $request->cpf)->orwhere('email', '=', $request->email)->first();

        if ($itens !== null) {
            echo "<script language='javascript'> window.alert('O Síndico cadastrado já existe') </script>";
            return view('painel-adm.sindicos.create');
        }

        $tabela->save();
        $tabela2->save();
        return redirect()->route('sindicos.index');
    }

    public function edit(sindico $item){
        return view('painel-adm.sindicos.edit', ['item' => $item]);   
     }
 
 
     public function editar(Request $request, sindico $item){
         
        $item->nome = $request->nome;
        $item->email = $request->email;
        $item->cpf = $request->cpf;
        $item->telefone = $request->telefone;
        $item->credencial = $request->credencial;
        $item->data = $request->data;
       

        $oldcpf = $request->oldcpf;
        $oldemail = $request->oldemail;
        $oldcredencial = $request->oldcredencial;

        if($oldcpf != $request->cpf){
            $itens = sindico::where('cpf', '=', $request->cpf)->count();
            if($itens > 0){
                echo "<script language='javascript'> window.alert('CPF já Cadastrado!') </script>";
                return view('painel-adm.sindicos.edit', ['item' => $item]);   
                
            }
        }

        if($oldcredencial != $request->credencial){
            $itens = sindico::where('credencial', '=', $request->credencial)->count();
            if($itens > 0){
                echo "<script language='javascript'> window.alert('Credencial já Cadastrada!') </script>";
                return view('painel-adm.sindicos.edit', ['item' => $item]);   
                
            }
        }


        if($oldemail != $request->email){
            $itens = sindico::where('email', '=', $request->email)->count();
            if($itens > 0){
                echo "<script language='javascript'> window.alert('Email já Cadastrado!') </script>";
                return view('painel-adm.sindicos.edit', ['item' => $item]);   
                
            }
        }     

        $item->save();
         return redirect()->route('sindicos.index');
 
     }

     public function delete(sindico $item){
        $item->delete();
        return redirect()->route('sindicos.index');
     }

     public function modal($id){
        $item = sindico::orderby('id', 'desc')->paginate();
        return view('painel-adm.sindicos.index', ['itens' => $item, 'id' => $id]);
     } 
}
