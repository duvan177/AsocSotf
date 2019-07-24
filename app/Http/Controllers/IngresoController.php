<?php

namespace App\Http\Controllers;

use App\detalle_ingreso;
use Illuminate\Http\Request;

class IngresoController extends Controller
{
    

    public function createCompra(Request $request){

        $id_ingreso = $request->id_ingreso;
        $id_articulo = $request->articulo;
        $cantidad = $request->cantidad;
        $precio_comrpa = $request->preciocompra;
        $precio_venta = $request->precioventa;

        $detalle_ingreso = new detalle_ingreso();

        $detalle_ingreso->id_ingreso = $id_ingreso;
        $detalle_ingreso->id_articulo = $id_articulo;
        $detalle_ingreso->cantidad = $cantidad;
        $detalle_ingreso->precio_comrpa = $precio_comrpa;
        $detalle_ingreso->precio_venta = $precio_venta;

        $detalle_ingreso->save();


        $data = " registrado con exito";

        return response()->json($data);


    }
}
