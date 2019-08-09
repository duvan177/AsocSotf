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

        return response()->json($verificar);


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

        $detalle_ing = new detalle_ingreso;
         $detalle_ing->id_ingreso =$id_ingreso ;
         $detalle_ing->id_articulo=$id_articulo;
          $detalle_ing->cantidad=$cantidad;
          $detalle_ing->precio_comrpa=$precio_comrpa;
         $detalle_ing->precio_venta=$precio_venta;

         $detalle_ing->save();

         if ( $detalle_ing->save()) {
                    $data = "Guardado con exito";

         return response()->json($data);
             
         }else{
         $data = "error al guardar contactar con servicio";

         return response()->json($data);
       }
       
    }

    public function setIngresosTodo(){
        $est = 2;

        $count = detalle_ingreso::all()->count();

           $data = detalle_ingreso::orderBy('id','desc')->get();
         

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
            
            $ingreso->id_estado = 1;
            $ingreso->save();
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

    



      


    
}
