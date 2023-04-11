<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Apartamentos;
use App\Models\imoveis;
use App\Models\inquilino;
use App\Models\sindico;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ImoveisController extends Controller
{
    public function index()
    {
        $tabela = imoveis::orderBy('id', 'desc')->paginate();
        return view('painel-adm.imoveis.index', ['itens' => $tabela]);
    }

    public function create()
    {
        $edificios = Imoveis::select('edificio')->distinct()->get();
        return view('painel-adm.imoveis.create', ['edificios' => $edificios]);
    }

    public function getEdificios()
    {
        $edificios = Imoveis::select('edificio')->distinct()->get();
        return response()->json($edificios);
    }

    public function getApartamentos($edificio)
    {
        Log::info('getApartamentos called with edificio: ' . $edificio);
        $imovel = Imoveis::where('edificio', $edificio)->first();
        $apartamentos = Apartamentos::where('imovel_id', $imovel->id)->get();
        return response()->json($apartamentos->makeVisible('valor')); 
    }

    public function insert(Request $request)
    {

        $tabela = new imoveis();
        $tabela->edificio = $request->edificio;
        $tabela->matricula = $request->matricula;
        $tabela->endereco = $request->endereco;
        $tabela->bairro = $request->bairro;
        $tabela->numero = $request->numero;

        $itens = imoveis::where('edificio', '=', $request->edificio)->first();

        if ($itens !== null) {
            echo "<script language='javascript'> window.alert('O Imóvel cadastrado já existe') </script>";
            return view('painel-adm.imoveis.create');
        }

        $tabela->save();
        return redirect()->route('imoveis.index');
    }

    public function edit(imoveis $item)
    {
        return view('painel-adm.imoveis.edit', ['item' => $item]);
    }


    public function editar(Request $request, imoveis $item)
    {

        $item->edificio = $request->edificio;
        $item->matricula = $request->matricula;
        $item->endereco = $request->endereco;
        $item->bairro = $request->bairro;
        $item->numero = $request->numero;


        $oldnome = $request->oldnome;
        $oldmatricula = $request->oldmatricula;

        if ($oldnome != $request->nome) {
            $itens = imoveis::where('nome', '=', $request->nome)->count();
            if ($itens > 0) {
                echo "<script language='javascript'> window.alert('Nome já Cadastrado!') </script>";
                return view('painel-adm.imoveis.edit', ['item' => $item]);
            }
        }

        if ($oldmatricula != $request->matricula) {
            $itens = imoveis::where('nome', '=', $request->matricula)->count();
            if ($itens > 0) {
                echo "<script language='javascript'> window.alert('Essa matrícula já existe!') </script>";
                return view('painel-adm.imoveis.edit', ['item' => $item]);
            }
        }

        $item->save();
        return redirect()->route('imoveis.index');
    }

    public function delete(imoveis $item)
    {
        $item->delete();
        return redirect()->route('imoveis.index');
    }

    public function modal($id)
    {
        $item = imoveis::orderby('id', 'desc')->paginate();
        return view('painel-adm.imoveis.index', ['itens' => $item, 'id' => $id]);
    }
}
