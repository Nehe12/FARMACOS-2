<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\FarmacoController as FarmacoV1;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('login',[App\Http\Controllers\Api\LoginController::class, 'login']);
Route::apiResource('v1/farmacos', FarmacoV1::class)
      ->only(['index','show','destroy','search'])
      ->middleware('auth:sanctum');
Route::post('/search',[App\Http\Controllers\Api\V1\FarmacoController::class,'search']);
