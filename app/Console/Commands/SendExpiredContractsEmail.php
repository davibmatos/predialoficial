<?php

namespace App\Console\Commands;

use App\Mail\ExpiredContractsMail;
use App\Models\Contratos;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendExpiredContractsEmail extends Command
{
    protected $signature = 'email:sendExpiredContracts';

    protected $description = 'Envia um e-mail com a lista de contratos vencidos no final do dia';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Consultar contratos vencidos
        $expiredContracts = Contratos::with('apartamento.imovel')
            ->where('status_id', 4) // ID 4 é o status 'vencido'
            ->get();

        // Enviar e-mail com a lista de contratos vencidos
        $email = new ExpiredContractsMail($expiredContracts);
        Mail::to('davibmatos@gmail.com')->send($email);
    }
}
