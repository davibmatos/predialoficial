<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use App\Models\Contratos;
use App\Models\Imoveis;
use App\Models\inquilino;
use App\Models\sindico;
use App\Models\Status;
use App\Models\usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InquilinosController extends Controller
{
    public function buscarPorCpf($cpf = null)
    {
        if (!$cpf) {
            return new JsonResponse(null, 400);
        }

        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        Log::info('Buscando inquilinos com CPF:', ['cpf' => $cpf]);

        $inquilinos = inquilino::where('cpf', $cpf)->get();

        Log::info('Inquilinos encontrados:', ['inquilinos' => $inquilinos]);

        return new JsonResponse($inquilinos);
    }

    public function index()
    {
        $tabela = inquilino::orderBy('id', 'desc')->paginate();
        return view('painel-adm.inquilinos.index', ['itens' => $tabela]);
    }

    public function create()
    {
        $edificios = Imoveis::select('edificio')->distinct()->get();
        $statuses = Status::all();
        $imoveis = Imoveis::all(); // Adicione esta linha
        return view('painel-adm.inquilinos.create', ['edificios' => $edificios, 'statuses' => $statuses, 'imoveis' => $imoveis]); // Adicione 'imoveis' => $imoveis
    }

    public function insert(Request $request)
    {

        $tabela = new inquilino();
        $tabela->nome = $request->nome;
        $tabela->email = $request->email;
        $tabela->cpf = preg_replace('/[^0-9]/', '', $request->cpf);
        $tabela->telefone = $request->telefone;
        $tabela->telefone2 = $request->telefone2;
        $tabela->rg = $request->rg;
        $tabela->observacoes = $request->observacoes;


        $itens = inquilino::where('cpf', '=', $request->cpf)->orwhere('email', '=', $request->email)->first();

        if ($itens !== null) {
            echo "<script language='javascript'> window.alert('O Síndico cadastrado já existe') </script>";
            return view('painel-adm.inquilinos.create');
        }

        $tabela->save();
        

        $statusAVencer = Status::where('status', 'a vencer')->first();

        $contrato = new Contratos();
        $contrato->inquilino_id = $tabela->id;
        Log::info('Contrato criado com inquilino_id:', ['inquilino_id' => $contrato->inquilino_id]);
        $contrato->apartamento_id = $request->apartamento_id;
        $contrato->vencimento = $request->vencimento;
        $contrato->status_id = $statusAVencer->id;
        $contrato->save();

        return redirect()->route('inquilinos.index');
    }

    public function edit(inquilino $item)
    {
        return view('painel-adm.inquilinos.edit', ['item' => $item]);
    }


    public function editar(Request $request, inquilino $item)
    {

        $item->nome = $request->nome;
        $item->email = $request->email;
        $item->cpf = $request->cpf;
        $item->telefone = $request->telefone;
        $item->telefone2 = $request->telefone2;
        $item->rg = $request->rg;
        $item->observacoes = $request->observacoes;


        $oldcpf = $request->oldcpf;
        $oldemail = $request->oldemail;

        if ($oldcpf != $request->cpf) {
            $itens = inquilino::where('cpf', '=', $request->cpf)->count();
            if ($itens > 0) {
                echo "<script language='javascript'> window.alert('CPF já Cadastrado!') </script>";
                return view('painel-adm.inquilinos.edit', ['item' => $item]);
            }
        }

        if ($oldemail != $request->email) {
            $itens = inquilino::where('email', '=', $request->email)->count();
            if ($itens > 0) {
                echo "<script language='javascript'> window.alert('Email já Cadastrado!') </script>";
                return view('painel-adm.inquilinos.edit', ['item' => $item]);
            }
        }

        $item->save();
        return redirect()->route('inquilinos.index');
    }

    public function delete(inquilino $item)
    {
        $item->delete();
        return redirect()->route('inquilinos.index');
    }

    public function modal($id)
    {
        $item = inquilino::orderby('id', 'desc')->paginate();
        return view('painel-adm.inquilinos.index', ['itens' => $item, 'id' => $id]);
    }
}
