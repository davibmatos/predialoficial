<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\imoveis;
use App\Models\inquilino;
use App\Models\sindico;
use App\Models\usuario;
use Illuminate\Http\Request;

class ImoveisController extends Controller
{
    public function index()
    {
        $tabela = imoveis::orderBy('id', 'desc')->paginate();
        return view('painel-adm.imoveis.index', ['itens' => $tabela]);
    }

    public function create()
    {
        return view('painel-adm.imoveis.create');
    }

    public function insert(Request $request)
    {
        
        $tabela = new imoveis();
        $tabela->nome = $request->nome;
        $tabela->matricula = $request->matricula;
        $tabela->endereco = $request->endereco;
        $tabela->bairro = $request->bairro;
        $tabela->numero = $request->numero;       

        $itens = imoveis::where('nome', '=', $request->nome)->first();

        if ($itens !== null) {
            echo "<script language='javascript'> window.alert('O Imóvel cadastrado já existe') </script>";
            return view('painel-adm.imoveis.create');
        }

        $tabela->save();
        return redirect()->route('imoveis.index');
    }

    public function edit(imoveis $item){
        return view('painel-adm.imoveis.edit', ['item' => $item]);   
     }
 
 
     public function editar(Request $request, imoveis $item){
         
        $item->nome = $request->nome;
        $item->matricula = $request->matricula;
        $item->endereco = $request->endereco;
        $item->bairro = $request->bairro;
        $item->numero = $request->numero;
       

        $oldnome = $request->oldnome;
        $oldmatricula = $request->oldmatricula;

        if($oldnome != $request->nome){
            $itens = imoveis::where('nome', '=', $request->nome)->count();
            if($itens > 0){
                echo "<script language='javascript'> window.alert('Nome já Cadastrado!') </script>";
                return view('painel-adm.imoveis.edit', ['item' => $item]);   
                
            }
        } 

        if($oldmatricula != $request->matricula){
            $itens = imoveis::where('nome', '=', $request->matricula)->count();
            if($itens > 0){
                echo "<script language='javascript'> window.alert('Essa matrícula já existe!') </script>";
                return view('painel-adm.imoveis.edit', ['item' => $item]);   
                
            }
        } 

        $item->save();
         return redirect()->route('imoveis.index');
 
     }

     public function delete(imoveis $item){
        $item->delete();
        return redirect()->route('imoveis.index');
     }

     public function modal($id){
        $item = imoveis::orderby('id', 'desc')->paginate();
        return view('painel-adm.imoveis.index', ['itens' => $item, 'id' => $id]);
     } 
}
