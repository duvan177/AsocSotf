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
                 $date = Carbon::now();    
                  $day = $date->format('Y-m-d');  
            $compras = detalle_ingreso::whereDate('created_at',$day)->get();
            
       

            foreach ($compras as $key => $value) {
               $suma = $suma + ($value->cantidad * $value->precio_comrpa);
            }

          $ventas = (int)Venta::sum('total_venta');

          $data2 = [ 'ventas'=>$ventas,
          'compras'=>$suma];
          

          return response()->json($data2);

    }
}
