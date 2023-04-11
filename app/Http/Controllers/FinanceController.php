<?php

namespace App\Http\Controllers;

use App\Models\Contratos;

class FinanceController extends Controller
{
    public function index()
    {
        // Valores recebidos no mês atual
        $valoresRecebidos = Contratos::with('apartamento')
            ->where('status_id', 3)
            ->whereMonth('vencimento', now()->month)
            ->get()
            ->sum(function ($contrato) {
                return $contrato->apartamento->valor;
            });

        // Valores a receber (excluindo os recebidos)
        $valoresAReceber = Contratos::with('apartamento')
            ->where('status_id', '<>', 3)
            ->get()
            ->sum(function ($contrato) {
                return $contrato->apartamento->valor;
            });

        // Valores pendentes no mês atual
        $valoresPendentes = Contratos::with('apartamento')
            ->where('status_id', 4)
            ->whereMonth('vencimento', now()->month)
            ->get()
            ->sum(function ($contrato) {
                return $contrato->apartamento->valor;
            });

        return view('painel-adm.financeiro.index', compact('valoresRecebidos', 'valoresAReceber', 'valoresPendentes'));
    }
}
