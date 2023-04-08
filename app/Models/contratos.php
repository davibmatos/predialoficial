<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contratos extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [        
        'inquilino_id',
        'apartamento_id',
        'vencimento'
    ];
    public function inquilino()
    {
        return $this->belongsTo(Inquilino::class);
    }
}
