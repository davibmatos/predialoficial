<?php

namespace App\Console\Commands;

use App\Models\Contratos;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateContratosStatus extends Command
{
    protected $signature = 'update:contratos-status';

    protected $description = 'Update contratos status baseado na data';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = now();

        // Get all 'a vencer' contratos
        $contratos = Contratos::where('status_id', 1)->get();

        foreach ($contratos as $contrato) {
            $vencimento = Carbon::parse($contrato->vencimento);

            // If the vencimento day is in the past and status is 'a vencer', set status to 'vencido'
            if ($vencimento->isPast() && $vencimento->day < $today->day) {
                $contrato->update(['status_id' => 4]);
            }
        }

        // At the first day of each month, set all contratos status to 'a vencer'
        if ($today->day == 1) {
            Contratos::query()->update(['status_id' => 1]);
        }
    }
}
