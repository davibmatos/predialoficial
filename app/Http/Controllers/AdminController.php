<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Apartamentos;
use App\Models\Contratos;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $totalImoveis = Apartamentos::count();

        $imoveisLocados = DB::table('contratos')
            ->distinct('apartamento_id')
            ->count('apartamento_id');

        $imoveisDisponiveis = $totalImoveis - $imoveisLocados;

        return view('painel-adm.index', [
            'totalImoveis' => $totalImoveis,
            'imoveisDisponiveis' => $imoveisDisponiveis,
            'imoveisLocados' => $imoveisLocados
        ]);
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
