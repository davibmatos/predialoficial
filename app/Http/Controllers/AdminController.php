<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Apartamentos;
use App\Models\Contratos;
use App\Models\Imoveis;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $imoveis = Imoveis::with('apartamentos')->get();
        $imoveisData = [];
    
        foreach ($imoveis as $imovel) {
            $totalImoveis = $imovel->apartamentos->count();
            $apartamentoIds = $imovel->apartamentos->pluck('id');
            $imoveisLocados = Contratos::whereIn('apartamento_id', $apartamentoIds)->distinct()->count('apartamento_id');
            $imoveisDisponiveis = $totalImoveis - $imoveisLocados;
    
            $imoveisData[] = [
                'nome' => $imovel->edificio,
                'total' => $totalImoveis,
                'disponiveis' => $imoveisDisponiveis,
                'locados' => $imoveisLocados
            ];
        }
    
        return view('painel-adm.index', ['imoveisData' => $imoveisData]);
    }
    
    public function getTotalImoveis()
    {
        return Apartamentos::count();
    }

    public function getImoveisDisponiveis()
    {
        return Apartamentos::whereNotIn('id', Contratos::select('apartamento_id'))->count();
    }

    public function getImoveisLocados()
    {
        return Contratos::count();
    }
}
