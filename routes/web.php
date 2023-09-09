<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApartamentosController;
use App\Http\Controllers\CadSindicosController;
use App\Http\Controllers\ContratosController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImoveisController;
use App\Http\Controllers\InquilinosController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Js;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('home');

Route::post('painel', [UsuariosController::class, 'login'])->name('usuarios.login');
Route::get('/', [UsuariosController::class, 'logout'])->name('usuarios.logout');

Route::put('admin/{usuario}', [AdminController::class, 'editar'])->name('admin.editar');
Route::get('home-admin', [AdminController::class, 'index'])->name('admin.index');

//ROTAS DE SINDICOS
Route::get('sindicos', [CadSindicosController::class, 'index'])->name('sindicos.index');
Route::post('sindicos', [CadSindicosController::class, 'insert'])->name('sindicos.insert');
Route::get('sindicos/inserir', [CadSindicosController::class, 'create'])->name('sindicos.inserir');
Route::put('sindicos/{item}', [CadSindicosController::class, 'editar'])->name('sindicos.editar');
Route::get('sindicos/{item}/edit}', [CadSindicosController::class, 'edit'])->name('sindicos.edit');
Route::get('sindicos/{item}/delete}', [CadSindicosController::class, 'modal'])->name('sindicos.modal');
Route::delete('sindicos/{item}', [CadSindicosController::class, 'delete'])->name('sindicos.delete');

//ROTAS DE INQUILINOS
Route::get('inquilinos', [InquilinosController::class, 'index'])->name('inquilinos.index');
Route::post('inquilinos', [InquilinosController::class, 'insert'])->name('inquilinos.insert');
Route::get('inquilinos/inserir', [InquilinosController::class, 'create'])->name('inquilinos.inserir');
Route::put('inquilinos/{item}', [InquilinosController::class, 'editar'])->name('inquilinos.editar');
Route::get('inquilinos/{item}/edit}', [InquilinosController::class, 'edit'])->name('inquilinos.edit');
Route::get('inquilinos/{item}/delete}', [InquilinosController::class, 'modal'])->name('inquilinos.modal');
Route::delete('inquilinos/{item}', [InquilinosController::class, 'delete'])->name('inquilinos.delete');

//ROTAS DE IMOVEIS
Route::get('imoveis', [ImoveisController::class, 'index'])->name('imoveis.index');
Route::post('imoveis', [ImoveisController::class, 'insert'])->name('imoveis.insert');
Route::get('imoveis/inserir', [ImoveisController::class, 'create'])->name('imoveis.inserir');
Route::put('imoveis/{item}', [ImoveisController::class, 'editar'])->name('imoveis.editar');
Route::get('imoveis/{item}/edit}', [ImoveisController::class, 'edit'])->name('imoveis.edit');
Route::get('imoveis/{item}/delete}', [ImoveisController::class, 'modal'])->name('imoveis.modal');
Route::delete('imoveis/{item}', [ImoveisController::class, 'delete'])->name('imoveis.delete');
Route::get('imoveis/{id}/details', [ImoveisController::class, 'show'])->name('imoveis.show');



//ROTAS DE APARTAMENTOS
Route::get('apartamentos', [ApartamentosController::class, 'index'])->name('apartamentos.index');
Route::post('apartamentos', [ApartamentosController::class, 'insert'])->name('apartamentos.insert');
Route::get('apartamentos/inserir', [ApartamentosController::class, 'create'])->name('apartamentos.inserir');
Route::put('apartamentos/{item}', [ApartamentosController::class, 'editar'])->name('apartamentos.editar');
Route::get('apartamentos/{item}/edit}', [ApartamentosController::class, 'edit'])->name('apartamentos.edit');
Route::get('apartamentos/{item}/delete}', [ApartamentosController::class, 'modal'])->name('apartamentos.modal');
Route::delete('apartamentos/{item}', [ApartamentosController::class, 'delete'])->name('apartamentos.delete');

//ROTAS DE CONTRATOS
Route::get('contratos', [ContratosController::class, 'index'])->name('contratos.index');
Route::post('contratos', [ContratosController::class, 'insert'])->name('contratos.insert');
Route::get('contratos/inserir', [ContratosController::class, 'create'])->name('contratos.inserir');
Route::put('contratos/{item}', [ContratosController::class, 'editar'])->name('contratos.editar');
Route::get('contratos/{item}/edit', [ContratosController::class, 'edit'])->name('contratos.edit');
Route::get('contratos/{item}/delete', [ContratosController::class, 'modal'])->name('contratos.modal');
Route::delete('contratos/{item}', [ContratosController::class, 'delete'])->name('contratos.delete');
Route::get('inquilinos/por-cpf/{cpf?}', [InquilinosController::class, 'buscarPorCpf'])->name('inquilinos.por_cpf');
Route::get('/imoveis/edificios', [ImoveisController::class, 'getEdificios'])->name('imoveis.edificios');
Route::get('/imoveis/{edificio}/apartamentos', [ImoveisController::class, 'getApartamentos'])->name('imoveis.apartamentos');
Route::put('/contratos/{contrato}/updateStatus', [ContratosController::class, 'updateStatus'])->name('contratos.updateStatus');
Route::put('contratos/{contrato}/update-vencimento', [ContratosController::class, 'updateVencimento'])->name('contratos.updateVencimento');
Route::get('/contratos/imovel/{id}', [ContratosController::class, 'showByBuilding'])->name('contratos.showByImovel');



//PAINEL FINANCEIRO
Route::get('/financeiro', [FinanceController::class, 'index'])->name('finance.index');





