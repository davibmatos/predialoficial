<?php

namespace App\Http\Controllers;

use App\Models\Contratos;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class FinanceController extends Controller
{
    public function index()
    {
        $anoAtual = Carbon::now()->year;
        $mesAtual = Carbon::now()->month;
        $mesAnterior = Carbon::now()->subMonth()->month;
        $mesAntesDoAnterior = Carbon::now()->subMonths(2)->month;

        $dadosMesAtual = $this->getDadosFinanceiros($mesAtual, $anoAtual);
        $dadosMesAnterior = $this->getDadosFinanceiros($mesAnterior, $anoAtual);
        $dadosMesAntesDoAnterior = $this->getDadosFinanceiros($mesAntesDoAnterior, $anoAtual);

        Log::info("Dados Mês Atual: " . json_encode($dadosMesAtual));

        return view('painel-adm.financeiro.index', compact('dadosMesAtual', 'dadosMesAnterior', 'dadosMesAntesDoAnterior'));
    }

    public function getDadosFinanceiros($month, $year)
    {
        $today = Carbon::now();
        $currentMonth = $today->month;
        $currentDay = $today->day;

        $valoresRecebidos = 0;
        $valoresAReceber = 0;
        $valoresPendentes = 0;

        // Lista para armazenar apartamentos já contabilizados
        $apartamentosContabilizados = [];

        // Obtenha todos os contratos
        $contratos = Contratos::all();

        foreach ($contratos as $contrato) {
            $vencimentoDate = Carbon::create($year, $month, $contrato->vencimento);

            // Verifique se o apartamento já foi contabilizado
            $apartamentoId = $contrato->apartamento_id;
            $edificioId = $contrato->apartamento->edificio_id;
            $chaveApartamento = "{$edificioId}_{$apartamentoId}";

            if (in_array($chaveApartamento, $apartamentosContabilizados)) {
                continue;
            }

            if ($vencimentoDate->month == $month && $vencimentoDate->year == $year) {
                if ($contrato->status_id == 1) {
                    // Verificar se o contrato está "a vencer" no mês corrente
                    $valoresAReceber += $contrato->apartamento->valor;
                    $apartamentosContabilizados[] = $chaveApartamento;
                } elseif ($contrato->status_id == 3) {
                    $pagamentoDate = Carbon::parse($contrato->updated_at);
                    if ($pagamentoDate->month == $month && $pagamentoDate->year == $year) {
                        $valoresRecebidos += $contrato->apartamento->valor;
                        $apartamentosContabilizados[] = $chaveApartamento;
                    }
                } elseif ($contrato->status_id == 4) {
                    if ($currentMonth == $month) {
                        $valoresPendentes += $contrato->apartamento->valor;
                        $apartamentosContabilizados[] = $chaveApartamento;
                    }
                }
            }
        }

        return [
            'valoresRecebidos' => $valoresRecebidos,
            'valoresAReceber' => $valoresAReceber,
            'valoresPendentes' => $valoresPendentes,
        ];
    }
}



if($acao == "PASTAVINCULO" &&npjur){
    $npjur = str_pad($npjur, 7, "0", STR_PAD_LEFT);
    $sSqLP = "Update tem_atualiza_projuris set atualizado" = '$dData', resultado = '$situacao_robo' where npjur = '$npjur';
    $db->Execute($sSqLP) or die ("erro");

    echo json_encode("Atualizado com sucesso. NPJUR: $npjur");
}


$id_geusuar = 10;

$script = "select * from usuario where id = $id";

$resultado = $db->Execute($script) or die($script. "<br>" .$db->ErrorMsg());
if($resultado->numRows() < 0){
    while(!$resultado->EOF){

    $sRetorno["nome"] = $resultado->fields["nome"];
    $sRetorno["email"] = $resultado->fields["email"];

    $result->MoveNext();
    }
}

<script>
function jsVerificaInformacao(valor){
    var url = "verifica_informacao.php"
    $.ajax({
        type: "POST",
        url: url, 
        data: "valor="+valor,
        dataType: 'json', 
        success: function(data) {
            if (data.resultado == '1') {
                alert(data.mensagem);
            }
            else{
                alert("ocorreu um erro");
            }
        }
    });
}
<script>


