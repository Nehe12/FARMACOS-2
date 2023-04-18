<?php

use App\Http\Controllers\BibliografiaController;
use App\Http\Controllers\FarmacoController;
use App\Http\Controllers\GrupoFarmacoController;
use App\Http\Controllers\InteraccionesController;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;

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


Route::controller(FarmacoController::class)->group(function () {
    Route::get('/', "index")->name('inicio');
    Route::get('/updateA','activo')->name('activar.farmaco');
    Route::get('/farmaco',"create")->name('crear.farmaco');
    // Route::get('/farmaco', "create")->name('crear.farmaco');
    Route::post('/farmaco/saveForm', 'store')->name('store.farmaco');

    Route::get('/editarFarmaco/{id}', "edit")->name('edit.farmaco');
    Route::put('/update/{id}', 'update')->name('update.farmaco');
    // Route::put('/actualizar-estado/{id}', 'FarmacoController@activo')->name('activar.farmaco');
   
    Route::get('/eliminar/{id}', "show")->name('show.farmaco');
    Route::delete('/destroy/{id}', "destroy")->name('destroy.farmaco');
    Route::get('/mostrar/{id}', 'mostrar')->name('ver.farmaco');
});
Route::controller(BibliografiaController::class)->group(function () {
    Route::get('/bibliografia', 'create')->name('create.bibliografia');
    Route::get('/editBibliografia','index')->name('show.biblios');
    Route::post('/bibliografia/savebiblio', 'store')->name('store.bibliografia');
    Route::put('/updateB','update')->name('update.biblio');
    Route::delete('/destroyB/{id}','destroy')->name('destroy.biblio');
});
Route::controller(GrupoFarmacoController::class)->group(function () {
    Route::get('/grupo', 'create')->name('create.grupo');
    Route::get('/editGrupo','index')->name('show.grupos');
    Route::post('/grupo/saveGroup', 'store')->name('store.grupo');
    Route::put('/updateG','update')->name('update.grupo');
    Route::delete('/destroyG/{id}','destroy')->name('destroy.grupo');
});
Route::controller(InteraccionesController::class)->group(function () {
    // route::get('/interacciones','create')->name('create.interacciones');
   
    route::post('/guardar', 'store')->name('store.interacciones');
    route::post('/guardari', 'store2')->name('store2.interacciones');
    route::get('/interacciones/{id}', 'edit')->name('edit.interacciones');
    route::put('/updateI', 'update')->name('update.interacciones');
    Route::delete('/destroyI/{id}', 'destroy')->name('destroy.interaccion');
});
