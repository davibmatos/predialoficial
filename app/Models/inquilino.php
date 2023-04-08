<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquilino extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'inquilinos';

    protected $fillable = [
        'nome',
        'cpf',
        'email',
        'telefone',
        'senha',
        'endereco',
        'apartamentos',
        'docs'
    ];
}
