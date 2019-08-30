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


  $name = DB::table('detalle_ingreso')->distinct()->pluck('id_ingreso','id_articulo');
  $art_c = DB::table('detalle_ingreso')->distinct()->pluck('id_articulo');

  $id_art =  DB::table('articulo')->pluck('id');
  $superConsulta =[];
  $datos =[];
  $array_c = [];
  $consul_c =[];

  foreach ($name as $key => $value) {

$consulta= DB::table('articulo')
    ->join('estado','articulo.estado','=','estado.id')
   ->join('categoria','articulo.id_categoria','=','categoria.id')
   ->Join('detalle_ingreso','detalle_ingreso.id_articulo','=','articulo.id')
   ->where('articulo.id',$key)
    ->where('detalle_ingreso.id_ingreso',$value)

    ->select('articulo.id','articulo.codigo','articulo.nombre','articulo.stock','articulo.descripcion','estado.estado_articulo'
    ,'articulo.estado','articulo.id_categoria','categoria.nombre_categoria',
    'categoria.descripcion_categoria','detalle_ingreso.precio_comrpa','detalle_ingreso.precio_venta')
    ->first();
    array_push($superConsulta,$consulta);
  }
  foreach ($art_c as $key => $value) {
    array_push($datos,$value);
  }
    foreach ($id_art as $key => $value) {
    array_push($array_c,$value);
  }
 $array = array_diff( $array_c,$datos );

   foreach ($array as $key => $value) {

$consulta_null= DB::table('articulo')
    ->join('estado','articulo.estado','=','estado.id')
   ->join('categoria','articulo.id_categoria','=','categoria.id')

   ->where('articulo.id',$value)
    ->select('articulo.id','articulo.codigo','articulo.nombre','articulo.stock','articulo.descripcion','estado.estado_articulo'
    ,'articulo.estado','articulo.id_categoria','categoria.nombre_categoria',
    'categoria.descripcion_categoria')
    ->first();


    array_push($consul_c,$consulta_null);
  }

  $items_null =['items_null_c'=>$consul_c];
 array_push($superConsulta,$items_null);

            return response()->json($superConsulta);


}
    public function ver(Request $idA){

        //DESFRAGMENTO LOS PARAMETROS ENVIADOS DESDE EL BACKEND PARA USARLOS EN LA CONSULTA

        $dato = $idA->id;
        $cant = $idA->cantidad;


       // VALIDAR  QUE EL PRODUCTO EXISTA


        $validar = DB::table('articulo')
        ->select('codigo')
        ->where('codigo','=',$dato)->value('codigo');

        $validar_existencia = DB::table('articulo')
        ->select('stock')
        ->where('codigo','=',$dato)->value('stock');

        $control_venta = $validar_existencia - $cant;

        if ($cant == '' || $control_venta < 0) {

            $data = 1004;
            return response()->json($data);

        }

                // OPERACION CUANDO EL PRODUCTO SEA VALIDADO Y EXISTA



        if($validar == $dato){

         $idArticulo = DB::table('articulo')
        ->select('id')
        ->where('codigo','=',$dato)->value('id');
        $idIngresoMax = detalle_ingreso::where('id_articulo','=',$idArticulo)->max('id_ingreso');

         $consulta = DB::table('detalle_ingreso')
         ->join('articulo','detalle_ingreso.id_articulo','=','articulo.id')
         ->select('articulo.nombre','detalle_ingreso.precio_venta','articulo.id','articulo.codigo','articulo.stock')
         ->where('articulo.id','=',$idArticulo)
        ->where('id_ingreso','=',$idIngresoMax)
         ->first(); // FIN DE LA VALIDACIÓN



          if ($consulta == null ) {

            $data = 1005;
                return response()->json($data);
          }else {

        $precioT = $consulta->precio_venta * $cant;

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
