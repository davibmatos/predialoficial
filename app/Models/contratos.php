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
        'vencimento',
        'status_id'
    ];
    public function inquilino()
    {
        return $this->belongsTo(inquilino::class);
    }

    public function apartamento()
{
    return $this->belongsTo(Apartamentos::class, 'apartamento_id');
}

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
