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
Route::post('articulos','ArticuloController@getArticulos');
Route::post('eliminarArticulo','ArticuloController@deleteArticulo');
Route::post('categoria','ArticuloController@getCategoria');
Route::post('estado','ArticuloController@getEstado');
Route::post('guardararticulo','ArticuloController@guardarArticulo');
Route::post('editararticulo','ArticuloController@editarArticulo');

//categoria
Route::post('categoria','CategoriaController@getCategoria');
Route::post('eliminarCategoria','CategoriaController@deleteCategoria');
Route::post('guardarcategoria','CategoriaController@guardarCategoria');
Route::post('editarcategoria','CategoriaController@editarCategoria');

// crear personas 

Route::post('create_personas','personasController@create');
Route::post('get_provedores','personasController@setProvedores');

// registro entradas de articulos
Route::post('ingreso_articulo','IngresoController@createCompra');
// tipos de comprobantes
Route::post('get_comprobantes','IngresoController@setComprobantes');
// tipo de series 
Route::post('get_series','IngresoController@setSeries');
// registro de ingreso
Route::post('guardar_ingreso','IngresoController@createIngreso');
//ingresos en estado ejecuccion
Route::post('get_ingresosE','IngresoController@setIngresos');
// registro de ingreso
Route::post('RegistIngreso','IngresoController@RegistrarIngreso');
//traer todo los ingresos con sus datos
Route::post('setIngresosTodo','IngresoController@setIngresosTodo');
//suma de todas las compras
Route::post('getTotal_Compras','IngresoController@TotalCompras');
//buscar en los ingresos
Route::post('Buscar_Dato','IngresoController@Buscar');
//
Route::post('actualizar_ingreso','IngresoController@idIngreso');








