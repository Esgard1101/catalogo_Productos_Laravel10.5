<?php

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
    return redirect()->route('productos.index');
});

Route::get('productos/export-pdf', [App\Http\Controllers\ProductController::class, 'exportPDF'])->name('productos.export-pdf');
Route::get('productos/export-excel', [App\Http\Controllers\ProductController::class, 'exportExcel'])->name('productos.export-excel');
Route::resource('productos', App\Http\Controllers\ProductController::class);
Route::resource('categorias', App\Http\Controllers\CategoriaController::class);
Route::resource('marcas', App\Http\Controllers\MarcaController::class);
Route::resource('unidades', App\Http\Controllers\UnidadController::class);
