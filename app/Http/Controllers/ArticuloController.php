<?php

namespace App\Http\Controllers;
use App\detalle_ingreso;

use App\articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show(articulo $articulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function edit(articulo $articulo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, articulo $articulo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(articulo $articulo)
    {
        //
    }

    public function ver(Request $idA){

        //DESFRAGMENTO LOS PARAMETROS ENVIADOS DESDE EL BACKEND PARA USARLOS EN LA CONSULTA

        $dato = $idA->id;
        $cant = $idA->cantidad;
       
        
       // VALIDAR  QUE EL PRODUCTO EXISTA

        
        $validar = DB::table('articulo')
        ->select('codigo')
        ->where('codigo','=',$dato)->value('codigo');

        if ($cant == '') {
           
            $data = 1004;
            return response()->json( $data);

        }
 
                // OPERACION CUANDO EL PRODUCTO SEA VALIDADO Y EXISTA

        


        if($validar == $dato){
            

         $idArticulo = DB::table('articulo')
        ->select('id')
        ->where('codigo','=',$dato)->value('id');

         $consulta = DB::table('detalle_ingreso')
         ->join('articulo','detalle_ingreso.id_articulo','=','articulo.id')
         ->select('articulo.nombre','detalle_ingreso.precio_venta','articulo.id','articulo.codigo')
         ->where('articulo.id','=',$idArticulo)
         ->first(); // FIN DE LA VALIDACIÓN

         $precioDB = DB::table('detalle_ingreso')
         ->join('articulo','detalle_ingreso.id_articulo','=','articulo.id')
         ->select('detalle_ingreso.precio_venta')
         ->where('detalle_ingreso.id_articulo','=',$idArticulo)
         ->value('detalle_ingreso.precio_venta');
     
          if ($consulta == null) {
              $data = 1005;
                return response()->json($data);
          }else {
                 
         $precioT = $precioDB * $cant;

         // CARGO UNA VARIABLE ARRAY PARA GUARDAR EL PARÁMETRO Y A CONSULTA DEL PRODUCTO

            $cantidad2=[
              'cantidad'=>$cant,
             'datos'=>$consulta,
             'totalPagar'=>$precioT
             ];
   
             
            //EN VIO LA VARIABLE EN UN RESPONSISE CON LOS DOS OBJETOS 
          return response()->json($cantidad2);
          }

        }
        // EN TAL CASO DE QUE EL CODIGO DEL PRODUCTO INSERTADO NO EXISTA

        else {
            $data = 404;
            return response()->json($data);
        }
      

        
           
      
        



                
    
         
     



      

       


      


    }
}
