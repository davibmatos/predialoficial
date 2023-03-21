<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\sindico;
use Illuminate\Http\Request;

class CadSindicosController extends Controller
{
   public function index(){
    $tabela = sindico::orderby('id', 'desc')->paginate();
    return view ('painel-adm.sindicos.index', ['itens' => $tabela]);

   }
}
