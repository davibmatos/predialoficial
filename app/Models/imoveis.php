<?php

namespace App\Models;

use App\Http\Controllers\ApartamentosController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imoveis extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function apartamentos()
    {
        return $this->hasMany(Apartamentos::class, 'imovel_id');
    }

    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'apartamento_id');
    }
}
