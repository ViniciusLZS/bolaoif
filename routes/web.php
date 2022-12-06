<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApostaController;
use App\Http\Controllers\AdicionarUser;
use App\Http\Controllers\ListarUsuario;

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

Route::post('/apostas/update', [ApostaController::class, 'update'])->name('apostas.update')->middleware('auth');
Route::resource('apostas', ApostaController::class)->except(['update']);
Route::get('/apostas', [ApostaController::class, 'index'])->name('apostas')->middleware('auth');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/cadastrar', [LoginController::class, 'cadastrar'])->name('cadastrar');

Route::get('/', [HomeController::class, 'index'])->name('welcome');


Route::get('/adicionarUsuario', [AdicionarUser::class, 'index'])->name('adicionarUser')->middleware('auth');

Route::get('/listarUsuario', [ListarUsuario::class, 'index'])->name('listarUsuario')->middleware('auth');
