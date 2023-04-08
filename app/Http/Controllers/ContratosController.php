<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\contratos;
use App\Models\inquilino;
use App\Models\sindico;
use App\Models\imoveis;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContratosController extends Controller
{
    public function index()
    {
        $tabela = contratos::orderBy('id', 'desc')->paginate();
        return view('painel-adm.contratos.index', ['itens' => $tabela]);
    }



    public function create()
    {
        $edificios = imoveis::select('edificio')->distinct()->get();
        return view('painel-adm.contratos.create', compact('edificios'));
    }

    public function insert(Request $request)
    {        
        Log::info('Inserindo contrato', $request->all());
        $request->validate([
            'inquilino_id' => 'required',
            'apartamento_id' => 'required',
            'vencimento' => 'required',            
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
    
        $tabela->save();
        return redirect()->route('contratos.index');
    }

    public function edit(contratos $item)
    {
        return view('painel-adm.inquilinos.edit', ['item' => $item]);
    }


    public function editar(Request $request, contratos $item)
    {

        $item->nome = $request->nome;
        $item->email = $request->email;
        $item->cpf = $request->cpf;
        $item->telefone = $request->telefone;


        $oldcpf = $request->oldcpf;
        $oldemail = $request->oldemail;

        if ($oldcpf != $request->cpf) {
            $itens = contratos::where('cpf', '=', $request->cpf)->count();
            if ($itens > 0) {
                echo "<script language='javascript'> window.alert('CPF já Cadastrado!') </script>";
                return view('painel-adm.contratos.edit', ['item' => $item]);
            }
        }

        $item->save();
        return redirect()->route('contratos.index');
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
}
