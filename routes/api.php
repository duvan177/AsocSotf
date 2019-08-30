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
Route::post('get_clientes','personasController@setClientes');

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
// consulta todos los ingresos con join
Route::post('todo_compras','IngresoController@todo_compras');
//
Route::post('todo_compras_x','IngresoController@todo_compras_detalle');
//
// buscar compra por numero de comprobante
Route::post('compra_x','IngresoController@buscar_compra_x_x');
//
//busca compras por fecha
//
Route::post('compra_x_fecha','IngresoController@buscar_compra_fecha');
//
Route::post('compra_x_mes','IngresoController@buscar_compra_x_mes');
//
Route::post('actualizar_ingreso','IngresoController@idIngreso');
Route::post('prueba','IngresoController@prueba');
// CREAR VENTA
Route::post('insert_venta','ventasController@ingresarVenta');
//api traer las ventas
Route::post('get_Ventas','ventasController@SetVentas');
// consuta a una venta en detalle
Route::post('get_Venta_','ventasController@SetVenta_');
// set venta por fecha
Route::post('get_Venta_fecha','ventasController@SetVenta_fecha');
//set ventas por mes
Route::post('get_Venta_mes','ventasController@SetVenta_mes');
// traer detalle venta
Route::post('get_Ventas_detalle','ventasController@setVentaDetalle');
//
//Gestion de usuarios
Route::post('usuario','Controllerusuarios@getUser');
Route::post('guardarusuario','Controllerusuarios@guardarUsuario');
Route::post('eliminarUsuario','Controllerusuarios@deleteUser');
// datos para el escritorio
Route::post('datos_ventas_compras','EscritorioController@datos_real');









