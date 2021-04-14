<?php

use App\Http\Controllers\api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/departamentos', [api::class, 'getDepartamentos']);
Route::get('/municipios', [api::class, 'getMunicipios']);
Route::post('/cotizacion/store', [api::class, 'storeCotizacion']);
Route::get('/db', [api::class, 'showRegistros']);


