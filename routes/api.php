<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|


Route::middleware(['auth:api','cors'])->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('fecha','fechaController@traer_fecha');
Route::post('NumeroFactura','fechaController@NumeroFactura');
Route::post('ver','ArticuloController@ver');
Route::post('articulo','ArticuloController@getArticulo');
Route::post('eliminarArticulo','ArticuloController@deleteArticulo');
Route::post('categoria','ArticuloController@getCategoria');
Route::post('estado','ArticuloController@getEstado');
Route::post('guardararticulo','ArticuloController@guardarArticulo');
Route::post('editararticulo','ArticuloController@editarArticulo');