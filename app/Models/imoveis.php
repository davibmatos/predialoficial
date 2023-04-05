<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imoveis extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function apartamentos()
    {
        return $this->hasMany(Apartamentos::class, 'imovel_id', 'id');
    }
}