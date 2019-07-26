<?php

namespace App\Http\Controllers;
use App\tipo_comprobante;
use App\serie_comprobante;
use App\detalle_ingreso;
use App\ingreso;
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

        $estado = DB::table('ingreso')
        ->select('id_estado')
        ->where('id_proveedor','=',$idProv)->value('id_estado');

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
        
        $ingreso->save(); 

        $data = "Guardado con exito";
        
        return response()->json($data);
        }

    }

    public function setIngresos()
    {

            $data = DB::table('ingreso')
            ->join('persona','ingreso.id_proveedor','=','persona.id')
            ->select('ingreso.id','persona.nombre','ingreso.id_estado','ingreso.num_comprobante')
            ->where('id_estado','=',2)->get();

            return response()->json($data);


    }

    public function RegistrarIngreso(Request $request){

        $id_ingreso = $request->id_ingreso;
        $id_articulo = $request->id_articulo;
        $cantidad =$request->cantidad;
        $precio_comrpa =$request->precio_comrpa;
        $precio_venta =$request->precio_venta;

        $detalle_ingreso = new detalle_ingreso();
         $detalle_ingreso->id_ingreso =$id_ingreso ;
         $detalle_ingreso->id_articulo=$id_articulo;
          $detalle_ingreso->cantidad=$cantidad;
          $detalle_ingreso->precio_comrpa=$precio_comrpa;
         $detalle_ingreso->precio_venta=$precio_venta;

         $detalle_ingreso->save();

         if ($detalle_ingreso->save()) {
             $data = [ msg=>"exito al guardar",data=>1002];
             return response()->json($data);
         }
         $data = "error al guardar contactar con servicio";

         return response()->json($data);
    }
}
