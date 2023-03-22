<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CadSindicosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;

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

Route::get('sindicos', [CadSindicosController::class, 'index'])->name('sindicos.index');
Route::post('sindicos.insert', [CadSindicosController::class, 'insert'])->name('sindicos.insert');
Route::get('sindicos.inserir', [CadSindicosController::class, 'create'])->name('sindicos.inserir');


