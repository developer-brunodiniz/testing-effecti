<?php

use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\LicitacoesController;
use App\Http\Controllers\ModalidadesController;
use App\Http\Controllers\StatusController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('status', [StatusController::class, 'index']);
Route::put('status/atualizar/{id?}', [StatusController::class, 'put'])
    ->where('id', '[0-9]+');
Route::post('status/criar', [StatusController::class, 'post']);
Route::match(['get', 'delete'], 'status/deletar/{id}', [StatusController::class, 'delete'])
    ->where('id', '[0-9]+');

Route::get('empresas', [EmpresasController::class, 'index']);
Route::put('empresa/atualizar/{id?}', [EmpresasController::class, 'put'])
    ->where('id', '[0-9]+');
Route::post('empresa/criar', [EmpresasController::class, 'post']);
Route::match(['get', 'delete'], 'empresa/deletar/{id}', [EmpresasController::class, 'delete'])
    ->where('id', '[0-9]+');

Route::get('modalidades', [ModalidadesController::class, 'index']);
Route::put('modalidade/atualizar/{id?}', [ModalidadesController::class, 'put'])
    ->where('id', '[0-9]+');
Route::post('modalidade/criar', [ModalidadesController::class, 'post']);
Route::match(['get', 'delete'], 'modalidade/deletar/{id}', [ModalidadesController::class, 'delete'])
    ->where('id', '[0-9]+');

Route::get('licitacoes', [LicitacoesController::class, 'index']);
Route::put('licitacoes/atualizar/{id?}', [LicitacoesController::class, 'put'])
    ->where('id', '[0-9]+');
Route::post('licitacoes/criar', [LicitacoesController::class, 'post']);
Route::match(['get', 'delete'], 'licitacoes/deletar/{id}', [LicitacoesController::class, 'delete'])
    ->where('id', '[0-9]+');
