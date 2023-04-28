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

        // Verificar se o número do apartamento já existe relacionado ao mesmo imóvel
        $apartamentoExistente = apartamentos::where('numero', $request->numero)
            ->where('imovel_id', $request->imovel_id)
            ->first();

        if ($apartamentoExistente !== null) {
            return back()->with('error', 'O apartamento cadastrado já existe.');
        }

        $tabela->save();
        return redirect()->route('apartamentos.index');
    }

    public function edit(apartamentos $item)
    {
        $imoveis = imoveis::whereNotNull('matricula')->where('matricula', '<>', '')->get();
        return view('painel-adm.apartamentos.edit', ['item' => $item, 'imoveis' => $imoveis]);
    }


    public function editar(Request $request, apartamentos $item)
    {

        $item->numero = $request->numero;
        $item->valor = (float) str_replace(',', '.', preg_replace('/[^\d,]/', '', $request->valor));


        $oldnumero = $request->oldnumero;
        

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
