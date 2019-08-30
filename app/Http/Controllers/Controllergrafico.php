<?php

namespace App\Http\Controllers;
use App\detalle_ingreso;
use App\detalle_venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Controllergrafico extends Controller
{
    public function detalleingGrafico(){
    $detalleing= DB::table('detalle_ingreso')
    ->select('detalle_ingreso.created_at')
    ->get();
    return response()->json($detalleing);
}
public function detallevenGrafico(){
    
        $detalleven= DB::table('detalle_venta')
        ->select('detalle_venta.created_at')
        ->get();
        return response()->json($detalleven);
    }
}
