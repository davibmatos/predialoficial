<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'status';

    public function contratos()
    {
        return $this->hasMany(Contrato::class);
    }
}
