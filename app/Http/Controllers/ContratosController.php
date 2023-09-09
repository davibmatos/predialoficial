<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Apartamentos;
use App\Models\contratos;
use App\Models\inquilino;
use App\Models\sindico;
use App\Models\imoveis;
use App\Models\Status;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContratosController extends Controller
{
    public function index()
    {
        $tabela = Contratos::with(['inquilino', 'apartamento', 'status'])->orderBy('id', 'desc')->paginate();
        $statuses = Status::all();
        return view('painel-adm.contratos.index', ['itens' => $tabela, 'statuses' => $statuses]);
    }



    public function create()
    {
        $edificios = Imoveis::select('edificio')->distinct()->get();
        return view('painel-adm.contratos.create', compact('edificios'));
    }

    public function insert(Request $request)
    {
        $request->validate([
            'inquilino_id' => 'required',
            'apartamento_id' => 'required',
            'vencimento' => 'required',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
        ]);

        Log::info('Inserindo contrato', $request->all());

        if ($request->has('inquilino_id')) {
            Log::info('Valor de inquilino_id', [$request->inquilino_id]);
        } else {
            Log::warning('inquilino_id não está presente na requisição');
        }

        $tabela = new contratos();
        $tabela->inquilino_id = $request->inquilino_id;
        $tabela->apartamento_id = $request->apartamento_id;
        $tabela->vencimento = $request->vencimento;
        $tabela->data_inicio = $request->data_inicio;
        $tabela->data_fim = $request->data_fim;
        $tabela->status_id = 1;

        $tabela->save();

        $tabela->save();
        return redirect()->route('contratos.index');
    }

    public function edit(contratos $item)
    {
        return view('painel-adm.contratos.edit', ['item' => $item]);
    }

    public function updateStatus(Request $request, Contratos $contrato)
    {
        $contrato->update(['status_id' => $request->status_id]);
        return redirect()->route('contratos.index')->with('success', 'Status atualizado com sucesso!');
    }

    public function updateVencimento(Request $request, Contratos $contrato)
    {
        $contrato->update(['vencimento' => $request->vencimento]);
        return redirect()->route('contratos.index')->with('success', 'Data de vencimento atualizada com sucesso!');
    }


    public function editar(Request $request, contratos $item)
    {
        $request->validate([
            'vencimento' => 'required',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
        ]);

        $item->vencimento = $request->vencimento;
        $item->data_inicio = $request->data_inicio;
        $item->data_fim = $request->data_fim;

        $item->save();

        return redirect()->route('contratos.index')->with('success', 'Contrato atualizado com sucesso!');
    }

    public function delete(contratos $item)
    {
        $item->delete();
        return redirect()->route('contratos.index');
    }

    public function modal($id)
    {
        $item = inquilino::orderby('id', 'desc')->paginate();
        return view('painel-adm.contratos.index', ['itens' => $item, 'id' => $id]);
    }

    public function showByBuilding($id)
    {
        // Obtendo o imóvel pelo ID
        $imovel = Imoveis::find($id);

        // Obtendo todos os apartamentos associados a esse imóvel
        $apartamentos = Apartamentos::where('imovel_id', $id)->get();

        $statuses = Status::all();  // Se você precisa dos status, como mencionado anteriormente.

        return view('painel-adm.contratos.showByBuilding', [
            'imovel' => $imovel,
            'apartamentos' => $apartamentos,
            'statuses' => $statuses
        ]);
    }
}
