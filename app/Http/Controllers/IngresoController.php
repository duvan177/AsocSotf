<?php

namespace App\Http\Controllers;
use App\Events\NotificacionEvent;
use App\tipo_comprobante;
use App\serie_comprobante;
use App\detalle_ingreso;
use App\ingreso;
use App\base_dia;
use App\articulo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



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
    public function setComprobantes(){

        $data = tipo_comprobante::all();
        return response()->json($data);


    }
    public function setSeries(){
        $data = serie_comprobante::all();
        return response()->json($data);

    }

    public function createIngreso(Request $request){

        $idProv = $request->id_proveedor;
        $num_comprobante = $request->num_comprobante;

        $estado = DB::table('ingreso')
        ->select('id_estado')
        ->where('id_proveedor','=',$idProv)->value('id_estado');

         $vali_comp = DB::table('ingreso')
        ->select('num_comprobante')
        ->where('num_comprobante','=',$num_comprobante)->get();


        if ($estado == 2) {

            $data=[
                'error'=>404,
                'msg'=>" compra en en ejecucion con este Provedor"
            ];


            return response()->json($data);
        }else {


        $id_proveedor = $request->id_proveedor;
        $id_tipo_comprobante = $request->id_tipo_comprobante;
        $id_serie_comprobante = $request->id_serie_comprobante;
        $num_comprobante = $request->num_comprobante;
        $id_estado = $request->id_estado;

        $ingreso = new ingreso();

                $ingreso->id_proveedor=$id_proveedor;

                $ingreso->id_tipo_comprobante=$id_tipo_comprobante;

                $ingreso->id_serie_comprobante=$id_serie_comprobante;

                $ingreso->num_comprobante=$num_comprobante;

                $ingreso->id_estado=$id_estado;

                if (count($vali_comp)<=0) {
                     $ingreso->save();

        $data = "Guardado con exito";

        return response()->json($data);

                }else{

        $data = 4004;

        return response()->json($data);
        }
    }


    }

    public function setIngresos()
    {

            $data = DB::table('ingreso')
            ->join('persona','ingreso.id_proveedor','=','persona.id')
            ->select('ingreso.id','persona.nombre','ingreso.id_estado','ingreso.num_comprobante')
            ->where('id_estado','=',2)->get();
         $cont =count($data);
         if ($cont == 0) {

              return response()->json(4004);

         }else {
             return response()->json($data);
         }


    }

    public function RegistrarIngreso(Request $request){

        $id_ingreso = $request->id_ingreso;
        $id_articulo = $request->articulo;
        $cantidad = $request->cantidad;
        $precio_comrpa =$request->precio_compra;
        $precio_venta =$request->precio_venta;

        $iva = $request->iva;

         $total_exist = DB::table('ingreso')->select('total_compra')->where('id','=',$id_ingreso)->value('total_compra');
         $total = $precio_comrpa * $cantidad;

         // ingreso para restar a la base
/*

      $date = Carbon::now();
      $day = $date->format('Y-m-d');
        $base_act = base_dia::select('base_final')->whereDate('created_at',$day)->value('base_final');
        $base_next = (int) $base_act - $total;
        $base_ = base_dia::whereDate('created_at',$day)->first();
        $base_->base_final = $base_next;
        $base_->save();*/
         // end base dia

         $total_real = $total_exist + $total;
        $ingreso_ = ingreso::find($id_ingreso);
        $ingreso_->total_compra = $total_real;
        $ingreso_->save();


        $detalle_ing = new detalle_ingreso;
         $detalle_ing->id_ingreso =$id_ingreso;
         $detalle_ing->id_articulo=$id_articulo;
          $detalle_ing->cantidad=$cantidad;
          $detalle_ing->total_iva=$iva;

          $detalle_ing->precio_comrpa=round($precio_comrpa,2);
         $detalle_ing->precio_venta=$precio_venta;
        $detalle_ing->save();

         $cantidad_exist = DB::table('articulo')->select('stock')->where('id','=',$id_articulo)->value('stock');
         $articulo = articulo::find($id_articulo);
         $cant_ex = $cantidad_exist + $cantidad;
         $limt = $articulo->limite;
         $articulo->stock = $cant_ex;

         if ($cant_ex >  $limt) {
            $articulo->estado = 5;
         }

          $articulo->save();
              return response()->json($total_real);

    }

    public function setIngresosTodo(Request $request){

        $id  = $request->id;

        $est = 2;


        $count = detalle_ingreso::where('id_ingreso',$id)->count();

           $data = detalle_ingreso::where('id_ingreso',$id)->orderBy('id','desc')->get();


           for ($i=0; $i <  $count ; $i++) {
                $data[$i]->ingreso->first();
                 $data[$i]->persona;
                  $data[$i]->articulo;


           }
            return response()->json($data);




    }
    public function TotalCompras(){

        $compras = detalle_ingreso::sum('precio_comrpa');

        return response()->json($compras);

    }

    public function Buscar(Request $request){

        $dato =(int) $request->buscar;
          function Even($data)
            {
	// returns if the input integer is even
	            if($data%2==0)
	            return TRUE;
	            else
	        return FALSE;
            }

        $count = detalle_ingreso::all()->count();

           $data = detalle_ingreso::orderBy('id','desc')->get();

           for ($i=0; $i <  $count ; $i++) {
                $data[$i]->ingreso;
                 $data[$i]->persona;
                  $data[$i]->articulo;
           }

    return response($consulta);
    }
    public function finalizarIngreso(Request $request){

    }
    public function idIngreso(Request $request){

        $id = $request->id;


        $ingreso = ingreso::where('id','=',$id)->first();


        if ($ingreso != ['']) {

           $total_i = $ingreso->total_compra;

         // ingreso para restar a la base
      $date = Carbon::now();
      $day = $date->format('Y-m-d');
        $base_act = base_dia::select('base_final')->whereDate('created_at',$day)->value('base_final');
        $base_next = (int) $base_act - $total_i;
        $base_ = base_dia::whereDate('created_at',$day)->first();
        $base_->base_final = $base_next;
        $base_->save();
         // end base dia


            $ingreso->id_estado = 1;
            $ingreso->save();
            event(new NotificacionEvent('nueva venta registrada'));


             $data = 200;
               return response()->json($data);
        }else {
            $data = 'el ingreso no se encuentra en la base de datos';
               return response()->json($data);


        }
    }

    public function prueba(Request $request){
          $id = $request->data;
        return response($id);
    }
    public function todo_compras(){

         $ingresos = DB::table('ingreso')
         ->join('persona','persona.id','=','ingreso.id_proveedor')
          ->join('tipo_comprobante','ingreso.id_tipo_comprobante','=','tipo_comprobante.id')
          ->select('ingreso.id','persona.nombre','ingreso.total_compra','ingreso.created_at','ingreso.num_comprobante','tipo_comprobante.Comprobante')
         ->get();

    return response()->json($ingresos);
    }

    public function todo_compras_detalle(Request $request){
      $id_ingreso = $request->id_ingreso;
       $ingresos = DB::table('detalle_ingreso')
         ->join('articulo','detalle_ingreso.id_articulo','=','articulo.id')
         ->where('id_ingreso',$id_ingreso)
         ->get();
    return response()->json($ingresos);
    }

    public function buscar_compra_x_x(Request $request){

        $num_comp = $request->num_comp;

          $ingresos = DB::table('ingreso')
         ->join('persona','persona.id','=','ingreso.id_proveedor')
          ->join('tipo_comprobante','ingreso.id_tipo_comprobante','=','tipo_comprobante.id')
          ->select('ingreso.id','persona.nombre','ingreso.total_compra','ingreso.created_at','ingreso.num_comprobante','tipo_comprobante.Comprobante')
          ->where('ingreso.num_comprobante',$num_comp)
          ->orWhere('persona.nombre','LIKE','%'.$num_comp.'%')
         ->get();

    return response()->json($ingresos);

    }
       public function buscar_compra_fecha(Request $request){

        $fecha = $request->fecha;

          $ingresos = DB::table('ingreso')
         ->join('persona','persona.id','=','ingreso.id_proveedor')
          ->join('tipo_comprobante','ingreso.id_tipo_comprobante','=','tipo_comprobante.id')
          ->select('ingreso.id','persona.nombre','ingreso.total_compra','ingreso.created_at','ingreso.num_comprobante','tipo_comprobante.Comprobante')
          ->WhereDate('ingreso.created_at',$fecha)
         ->get();

    return response()->json($ingresos);

    }
      public function buscar_compra_x_fecha(Request $request){

            $fecha = $request->fecha;
          $ingresos = DB::table('ingreso')
         ->join('persona','persona.id','=','ingreso.id_proveedor')
          ->join('tipo_comprobante','ingreso.id_tipo_comprobante','=','tipo_comprobante.id')
          ->select('ingreso.id','persona.nombre','ingreso.total_compra','ingreso.created_at','ingreso.num_comprobante','tipo_comprobante.Comprobante')
          ->WhereDate('ingreso.created_at',$fecha)
         ->get();
          if (count($ingresos)<=0) {
                return response()->json(404);
            }
            else {
                 return response()->json($ingresos);
            }
    }
      public function buscar_compra_x_mes(Request $request){

           $fecha = $request->fecha;
            $data1 = substr($fecha,-2);
            $data2 = substr($fecha,-8,4);
            $data =[ "mes"=>$data1,
            "año"=>$data2];

            $fecha = $request->fecha;
          $ingresos = DB::table('ingreso')
         ->join('persona','persona.id','=','ingreso.id_proveedor')
          ->join('tipo_comprobante','ingreso.id_tipo_comprobante','=','tipo_comprobante.id')
          ->select('ingreso.id','persona.nombre','ingreso.total_compra','ingreso.created_at','ingreso.num_comprobante','tipo_comprobante.Comprobante')
           ->whereYear('ingreso.created_at',$data2 )
            ->whereMonth('ingreso.created_at',$data1)
         ->get();
          if (count($ingresos)<=0) {
                return response()->json(404);
            }
            else {
                 return response()->json($ingresos);
            }

    }









}
