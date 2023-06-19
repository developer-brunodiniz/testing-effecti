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

Route::prefix('api/v1')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('status', [StatusController::class, 'index']);
    Route::put('status/atualizar/{id?}', [StatusController::class, 'update'])
        ->where('id', '[0-9]+');
    Route::post('status/criar', [StatusController::class, 'insert']);
    Route::match(['get', 'delete'], 'status/deletar/{id}', [StatusController::class, 'delete'])
        ->where('id', '[0-9]+');

    Route::get('empresas', [EmpresasController::class, 'index']);
    Route::put('empresa/atualizar/{id?}', [EmpresasController::class, 'update'])
        ->where('id', '[0-9]+');
    Route::post('empresa/criar', [EmpresasController::class, 'insert']);
    Route::put('empresa/deletar/{id}', [EmpresasController::class, 'delete'])
        ->where('id', '[0-9]+');

    Route::get('modalidades', [ModalidadesController::class, 'index']);
    Route::put('modalidade/atualizar/{id?}', [ModalidadesController::class, 'update'])
        ->where('id', '[0-9]+');
    Route::post('modalidade/criar', [ModalidadesController::class, 'insert']);
    Route::put('modalidade/deletar/{id}', [ModalidadesController::class, 'delete'])
        ->where('id', '[0-9]+');

    Route::get('licitacoes', [LicitacoesController::class, 'index']);
    Route::put('licitacao/atualizar/{id?}', [LicitacoesController::class, 'update'])
        ->where('id', '[0-9]+');
    Route::post('licitacao/criar', [LicitacoesController::class, 'insert']);
    Route::put('licitacao/deletar/{id}', [LicitacoesController::class, 'delete'])
        ->where('id', '[0-9]+');
});
