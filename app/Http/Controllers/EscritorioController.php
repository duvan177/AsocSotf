<?php

namespace App\Http\Controllers;
use App\detalle_venta;
use App\detalle_ingreso;
use App\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EscritorioController extends Controller
{


    public function datos_real(){

                $suma = 0;
                $suma2 = 0;
                 $date = Carbon::now();
                  $day = $date->format('Y-m-d');
            $compras = detalle_ingreso::whereDate('created_at',$day)->get();
             $ventas = Venta::whereDate('created_at',$day)->get();


            foreach ($compras as $key => $value) {
               $suma = $suma + ($value->cantidad * $value->precio_comrpa);
            }
             foreach ($ventas as $key => $value) {
               $suma2 = $suma2 + $value->total_venta;
            }

         // $ventas = Venta::sum('total_venta')->whereDate('created_at',$day)->get();

         $sum1 = number_format($suma2);
          $sum2 = number_format($suma);

          $data2 = [ 'ventas'=>$sum1,
          'compras'=>$suma];


          return response()->json($data2);

    }
}
