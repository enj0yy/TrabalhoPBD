<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicacaoController;

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



Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/publicacao/{id_publicacao}', [PublicacaoController::class, 'show'])->name('publicacao.show');
    Route::post('/publicar', [PublicacaoController::class, 'store'])->name('publicar');
    Route::post('/curtir/{id_publicacao}', [PublicacaoController::class, 'like'])->name('curtir');
    Route::post('/comentar/{id_publicacao}', [PublicacaoController::class, 'comment'])->name('comentar');

    Route::get('/usuario/{id_usuario}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/perfil/editar', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/editar', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/editar', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/seguir/{id_usuario}', [ProfileController::class, 'follow'])->name('seguir');
});

require __DIR__.'/auth.php';
