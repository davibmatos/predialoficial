<?php

namespace App\Console\Commands;

use App\Models\Contratos;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateContratosStatus extends Command
{
    protected $signature = 'update:contratos-status';

    protected $description = 'Update contratos status based on their vencimento date';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = now();

        // Get all 'a vencer' and 'pago' contratos
        $contratos = Contratos::whereIn('status_id', [1, 3])->get();

        foreach ($contratos as $contrato) {
            $vencimento = Carbon::parse($contrato->vencimento);

            // If the vencimento date is in the past, set status to 'vencido'
            if ($vencimento->lt($today)) {
                $contrato->update(['status_id' => 4]);
            }
            // If the vencimento date is in the current month, set status to 'a vencer'
            elseif ($vencimento->month == $today->month) {
                $contrato->update(['status_id' => 1]);
            }
        }
    }
}