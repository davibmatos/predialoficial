<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartamentos extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function imovel()
    {
        return $this->belongsTo(Imoveis::class, 'imovel_id', 'id');
    }
}