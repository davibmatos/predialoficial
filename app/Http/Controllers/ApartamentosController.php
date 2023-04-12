<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\apartamentos;
use App\Models\imoveis;
use App\Models\inquilino;
use App\Models\sindico;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApartamentosController extends Controller
{
    public function index()
{
    $tabela = Apartamentos::with('imovel')->orderBy('id', 'desc')->paginate();
    return view('painel-adm.apartamentos.index', ['itens' => $tabela]);
}

    public function create()
    {

        $imoveis = imoveis::whereNotNull('matricula')->where('matricula', '<>', '')->get();
        return view('painel-adm.apartamentos.create', compact('imoveis'));
    }

    public function insert(Request $request)
    {
        $tabela = new apartamentos();
        $tabela->numero = $request->numero;
        $tabela->valor = (float) str_replace(',', '.', preg_replace('/[^\d,]/', '', $request->valor));
        $tabela->imovel_id = $request->imovel_id;

        $itens = DB::table('apartamentos')
            ->join('imoveis', 'apartamentos.imovel_id', '=', 'imoveis.matricula')
            ->where('apartamentos.numero', '=', $request->numero)
            ->where('imoveis.matricula', '=', $request->matricula)
            ->first();

        if ($itens !== null) {
            echo "<script language='javascript'> window.alert('O apartamento cadastrado já existe') </script>";
            return view('painel-adm.apartamentos.create');
        }

        $tabela->save();
        return redirect()->route('apartamentos.index');
    }

    public function edit(apartamentos $item)
    {
        return view('painel-adm.apartamentos.edit', ['item' => $item]);
    }


    public function editar(Request $request, apartamentos $item)
    {

        $item->numero = $request->numero;
        $item->valor = (float) str_replace(',', '.', preg_replace('/[^\d,]/', '', $request->valor));


        $oldnumero = $request->oldnumero;

        if ($oldnumero != $request->numero) {
            $itens = apartamentos::where('numero', '=', $request->numero)->count();
            if ($itens > 0) {
                echo "<script language='javascript'> window.alert('O apartamento já está Cadastrado!') </script>";
                return view('painel-adm.apartamentos.edit', ['item' => $item]);
            }
        }

        $item->save();
        return redirect()->route('apartamentos.index');
    }

    public function delete(apartamentos $item)
    {
        $item->delete();
        return redirect()->route('apartamentos.index');
    }

    public function modal($id)
    {
        $item = apartamentos::orderby('id', 'desc')->paginate();
        return view('painel-adm.apartamentos.index', ['itens' => $item, 'id' => $id]);
    }
}
