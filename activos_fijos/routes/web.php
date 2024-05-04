<?php

use App\Http\Controllers\ActivoController;
use App\Http\Controllers\BajaController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
// Route::redirect('/', '/activos');
Route::prefix('activos')->group(function () {
    Route::get('/', [ActivoController::class, 'index'])->name('activos.index');
    Route::get('/create', [ActivoController::class, 'create'])->name('activos.create');
    Route::post('/', [ActivoController::class, 'store'])->name('activos.store');
    Route::get('/{activo}/edit', [ActivoController::class, 'edit'])->name('activos.edit');
    Route::put('/{activo}', [ActivoController::class, 'update'])->name('activos.update');
    Route::delete('/{activo}', [ActivoController::class, 'destroy'])->name('activos.destroy');
});

Route::prefix('bajas')->group(function () {
    Route::get('/', [BajaController::class, 'index'])->name('bajas.index');
    Route::get('/create', [BajaController::class, 'create'])->name('bajas.create');
    Route::post('/', [BajaController::class, 'store'])->name('bajas.store');
});
