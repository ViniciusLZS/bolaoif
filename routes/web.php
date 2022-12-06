<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApostaController;
use App\Http\Controllers\AdicionarUser;
use App\Http\Controllers\ListarUsuario;
use App\Http\Controllers\ListaUsuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Routes Apostas
Route::post('/apostas/update', [ApostaController::class, 'update'])->name('apostas.update')->middleware('auth');
Route::resource('apostas', ApostaController::class)->except(['update']);
Route::get('/apostas', [ApostaController::class, 'index'])->name('apostas')->middleware('auth');

//Routes Login / Cadastro / sair
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/cadastrar', [LoginController::class, 'cadastrar'])->name('cadastrar');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Route welcome
Route::get('/', [HomeController::class, 'index'])->name('welcome');

//Routes AdicionarUser
Route::get('/adicionarUsuario', [AdicionarUser::class, 'index'])->name('adicionarUser')->middleware('auth');

//Route ListarUsuario
Route::get('/listarUsuario', [ListaUsuarioController::class, 'index'])->name
('listarUsuario')->middleware('auth');

Route::post('/listaUsuario/update', [ListaUsuarioController::class, 'update'])->name('listaUsuario.update')->middleware('auth');

// Route::delete('/listaUsuario/{id}'[ListaUsuarioController::class], 'destroy');
Route::resource('listaUsuario', ListaUsuarioController::class)->except(['update']);