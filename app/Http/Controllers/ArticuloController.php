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

        $dato = $idA->id;
        $cant = $idA->cantidad;
       
        
        

        
        $validar = DB::table('articulo')
        ->select('codigo')
        ->where('codigo','=',$dato)->value('codigo');




        if($validar == $dato){
            

  $idArticulo = DB::table('articulo')
  ->select('id')
  ->where('codigo','=',$dato)->value('id');

  $consulta = DB::table('detalle_ingreso')
  ->join('articulo','detalle_ingreso.id_articulo','=','articulo.id')
  ->select('articulo.nombre','detalle_ingreso.precio_venta','articulo.id','articulo.codigo')
  ->where('detalle_ingreso.id_articulo','=',$idArticulo)
  ->first();

  

  
      $cantidad2=[
          'cantidad'=>$cant,
          'datos'=>$consulta
      ];


          return response()->json($cantidad2);

        }

        else {
            $data = 404;
            return response()->json( $data);
        }
      

        
           
      
        



                
    
         
     



      

       


      


    }
}
