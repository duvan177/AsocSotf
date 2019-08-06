<?php

namespace App\Http\Controllers;
use App\Venta;
use App\detalle_venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ventasController extends Controller
{
    
    public function ingresarVenta(Request $request){
        $num_comprobante =  $request->num_comp;
         $num_comprobante_validar = DB::table('venta')->select('num_comprobante')->where('num_comprobante','=',$num_comprobante)->get();

         if ( count($num_comprobante_validar)<=0){
        $id_cliente =  $request->id_cliente;
        $num_comprobante =  $request->num_comp;
        $total_venta =  $request->total_venta;
        $descuento = $request->descuento;
        $id_user =  $request->id_user;

        $venta = new Venta;
        $venta->id_cliente = $id_cliente;
        $venta->num_comprobante = $num_comprobante;
        $venta->total_venta =$total_venta;
        $venta->descuento = $descuento; 
        $venta->id_user=$id_user;
        $venta->save();
        


        if ($venta->save()) {

               $id_venta_ = DB::table('venta')->select('id')->where('num_comprobante','=',$num_comprobante)->get();
               


            
            return response()->json($id_venta_);
        }else {          
        return response()->json('error al insertar');
        }                      
         }else {
             return response()->json('numero comprobante ya registrado, Ingrese uno nuevo');     
        }
       

        


    }
}
