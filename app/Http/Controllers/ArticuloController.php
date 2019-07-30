<?php

namespace App\Http\Controllers;
use App\detalle_ingreso;

use App\articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ArticuloController extends Controller
{
  public function editarArticulo(Request $ia){
$id= $ia->id;
$id_categoria=$ia->categoriaEditar;
    $codigo=$ia->codigoEditar;
    $nombre=$ia->nombreEditar;
    $stock=$ia->stockEditar;
    $descripcion=$ia->descripcionEditar;
    $estado=$ia->estadoEditar;
    //editamos
    $articulo = articulo::find($id);
    $articulo->id_categoria=$id_categoria;
$articulo->codigo=$codigo;
$articulo->nombre=$nombre;
$articulo->stock=$stock;
$articulo->descripcion=$descripcion;
$articulo->estado=$estado;
$articulo->save();
  }
  public function guardarArticulo(Request $ia){
    
    $this->validate($ia,[
      'codigo'=>'required'
    ]);
      
    $id_categoria=$ia->categoria;
    $codigo=$ia->codigo;
    $nombre=$ia->nombre;
    $stock=$ia->stock;
    $descripcion=$ia->descripcion;
    $estado=$ia->estado;
    //guardamos en la base de datos
    $articulo = new articulo();
$articulo->id_categoria=$id_categoria;
$articulo->codigo=$codigo;
$articulo->nombre=$nombre;
$articulo->stock=$stock;
$articulo->descripcion=$descripcion;
$articulo->estado=$estado;
$articulo->save();
    
 
  }
  public function getCategoria(){
    $categoria= DB::table('categoria')
    ->select('categoria.id','categoria.nombre_categoria')
    ->get();
    
   
    return response()->json($categoria);
  }
  public function getEstado(){
    $estado= DB::table('estado')
    ->select('estado.id','estado.estado_articulo')
    ->get();
    return response()->json($estado);
  }
 
  public function deleteArticulo(Request $idA){
$id = $idA->id;
$articulo = articulo::destroy($id);

  }
public function getArticulo(){

//$cons = articulo::all();

$consulta= DB::table('articulo')
    ->join('estado','articulo.estado','=','estado.id')
   ->join('categoria','articulo.id_categoria','=','categoria.id')
    ->select('articulo.id','articulo.codigo','articulo.nombre','articulo.stock','articulo.descripcion','estado.estado_articulo','articulo.estado','articulo.id_categoria','categoria.nombre_categoria','categoria.descripcion_categoria')
    ->get(); 
      return response()->json($consulta);
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

          $idIngresoMax = detalle_ingreso::max('id_ingreso');
          
            

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
                return response()->json($consulta);
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

    public function getArticulos(){

      //$cons = articulo::all();
      
      $consulta= DB::table('articulo')
          ->join('estado','articulo.estado','=','estado.id')
         ->join('categoria','articulo.id_categoria','=','categoria.id')
          ->select('articulo.id','articulo.codigo','articulo.nombre')
          ->get(); 
            return response()->json($consulta);
      }

   
}
