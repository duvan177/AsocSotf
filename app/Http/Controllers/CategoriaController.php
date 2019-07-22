<?php

namespace App\Http\Controllers;
use App\categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CategoriaController extends Controller
{
public function editarCategoria(Request $ia){

$id=$ia->id;
$nombre_categoria=$ia->nombre_categoria_Editar;
$descripcion_categoria=$ia->descripcion_categoria_Editar;
//editamos
$categoria = categoria::find($id);
$categoria->nombre_categoria=$nombre_categoria;
$categoria->descripcion_categoria=$descripcion_categoria;
$categoria->save();
}
public function guardarCategoria(Request $ia){

    $this->validate($ia,[
        'nombre_categoria'=>'required'
      ]);
      $nombre_categoria= $ia->nombre_categoria;
      $descripcion_categoria= $ia->descripcion_categoria;
      //guardamos
      $categoria = new categoria();
   $categoria->nombre_categoria=$nombre_categoria;
   $categoria->descripcion_categoria=$descripcion_categoria;
   $categoria->save();
}
public function getCategoria(){
    $categoria= DB::table('categoria')
    ->select('categoria.id','categoria.nombre_categoria','categoria.descripcion_categoria')
    ->get();
    return response()->json($categoria);
}

public function deleteCategoria(Request $idA){
    $id = $idA->id;
    $categoria = categoria::destroy($id);
}
}