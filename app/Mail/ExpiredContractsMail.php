<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExpiredContracts extends Mailable
{
    use Queueable, SerializesModels;

    public $expiredContracts;

    public function __construct($expiredContracts)
    {
        $this->expiredContracts = $expiredContracts;
    }

    public function build()
    {
        return $this->view('emails.expired-contracts')
                    ->with(['expiredContracts' => $this->expiredContracts]);
    }
}