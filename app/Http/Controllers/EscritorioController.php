<?php

namespace App\Http\Controllers;
use App\detalle_venta;
use App\detalle_ingreso;
use App\Venta;
use App\base_dia;
use App\articulo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EscritorioController extends Controller
{


    public function datos_real(){

                $suma = 0;
                $suma2 = 0;
                $renta_ = 0;
                $cant_art_c = 0;
                   $cant_art_v = 0;

                 $date = Carbon::now();
                  $day = $date->format('Y-m-d');
            $compras = detalle_ingreso::whereDate('created_at',$day)->get();
             $ventas = Venta::whereDate('created_at',$day)->get();
             $v_art = detalle_venta::whereDate('created_at',$day)->get();


            foreach ($compras as $key => $value) {
               $suma +=$value->cantidad * $value->precio_comrpa;
               $cant_art_c += $value->cantidad;

            }
             foreach ($ventas as $key => $value) {
               $suma2+= $value->total_venta;
               $renta_ += $value->rentabilidad;
            }
            foreach ($v_art as $key => $value) {
                $cant_art_v += $value->cantidad;
            }



         // $ventas = Venta::sum('total_venta')->whereDate('created_at',$day)->get();

         $sum1 = number_format($suma);
          $sum2 = $suma2;
          $renta_ = $renta_;

          $data2 = [ 'ventas'=>$sum2,
          'compras'=>$sum1,
         'renta_d'=>$renta_,
        'cantidad_c'=>$cant_art_c,
    'cantidad_v'=>$cant_art_v];


          return response()->json($data2);

    }

    public function Base(){
        $date = Carbon::now();
        $day = $date->format('Y-m-d');
        $base = base_dia::select('base','base_final')->whereDate('created_at',$day)->first();
        if (count($base)<=0) {

            return response()->json(501);
        }
        else {


            $data = [ 'base_'=>$base, 'exit'=>808];


            return response()->json($data);
        }
    }
    public function save_base(Request $request){

        $base = $request->base;

        $base_dia = new base_dia();
        $base_dia->base = $base;
        $base_dia->base_final = $base;
        $base_dia->save();

        if ($base_dia->save()) {
            $date = Carbon::now();
            $day = $date->format('Y-m-d');
            $base_d = base_dia::whereDate('created_at',$day)->first();
            $datos_ = ['base_'=>$base_d, 'exit'=>201];;

            return response()->json($datos_);
        }else {
            return response()->json('error en guardar');
        }

    }

    public function Repeti2(){

        $articulos = articulo::select('id','nombre')->get();
        $detalle_v = detalle_venta::select('id_articulo')->get();
        $secuencia_art = [];
        $art_vent = [];
        $id_art=[];
        foreach ($detalle_v as $key => $value) {
            array_push($art_vent,$value->id_articulo);
        }
        $newArray =  array_unique($art_vent);

        foreach ($newArray as $key => $value) {
            array_push($id_art,$value);
        }
        foreach ($id_art as $key => $value) {
            $nom_arti_ = articulo::select('nombre')->where('id',$value)->value('nombre');
            $detalle = (int) detalle_venta::where('id_articulo','=',$value)->sum('cantidad');
            array_push($secuencia_art,[ 'name'=>$nom_arti_,'pv'=>$detalle]);
        }





        return response()->json($secuencia_art);



    }
}
