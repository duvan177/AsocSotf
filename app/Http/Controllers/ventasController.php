<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;   
use App\Venta;
use App\User;
use App\detalle_venta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class ventasController extends Controller
{
    
    public function ingresarVenta(Request $request){

     

        
    
        $num_comprobante =  $request->num_comp;
         $num_comprobante_validar = DB::table('venta')->select('num_comprobante')->where('num_comprobante','=',$num_comprobante)->get();

         if (count($num_comprobante_validar)<=0){
        $id_cliente = $request->cliente[0]['id'];
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
        //return response()->json('se guardo');  
        
        for ($i=0; $i< count($request->articulos) ; $i++) {  
       $id_venta_= DB::table('venta')->select('id')->where('num_comprobante','=',$num_comprobante)->value('id');
      
        $id_articulo = $request->articulos[$i]['datos']['id'];
        $cantidad = $request->articulos[$i]['cantidad'];
        $precio_venta = $request->articulos[$i]['datos']['precio_venta'];

        $detalle_venta = new detalle_venta();
        $detalle_venta->id_venta=$id_venta_;
        $detalle_venta->id_articulo=$id_articulo;
        $detalle_venta->cantidad=$cantidad;
        $detalle_venta->precio_venta=$precio_venta;

        $detalle_venta->save();
        }
        
        
         }
    
}
}


    
         
