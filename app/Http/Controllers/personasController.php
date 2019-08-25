<?php

namespace App\Http\Controllers;
use App\persona;
use App\detalle_ingreso;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class personasController extends Controller
{



   public function create(Request $request ){

    $nombre = $request->nombre;
    $TipoPersona = (int)$request->TipoPersona;
    $num_document =(int) $request->NumDocument;
    $direccion = $request->direccion;
    $selectedProvedor =(int) $request->selectedProvedor;
    $telefono =(int)$request->telefono;
    $email = $request->email;

    //insertamos en la tabla persona


    $persona = new persona;

    $persona->id_tipo_persona=$TipoPersona;
    $persona->nombre=$nombre;
    $persona->id_tipo_documento=$selectedProvedor;
    $persona->num_documento = $num_document;
    $persona->direccion=$direccion;
    $persona->telefono=$telefono;
    $persona->email=$email;

    $persona->save();



    $data =202;


   return response()->json($data);



    }

    public function setProvedores(){

         $data = DB::table('persona')
         ->select('id','nombre')->where('id_tipo_persona','=',3)->get();
         return response()->json($data);

    }
        public function setClientes(){

         $data = DB::table('persona')
         ->select('id','nombre')->where('id_tipo_persona','=',4)->get();
         return response()->json($data);

    }


}
