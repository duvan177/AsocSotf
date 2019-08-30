<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\usuarios;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class Controllerusuarios extends Controller
{
  
   public function getUser(){
    $usuario= DB::table('users')
    ->join('rol_usuario','rol_usuario.id','=','users.id_rol')
    ->select('users.id','users.name','users.id_rol','users.email','rol_usuario.rol')
    ->get();

    return response()->json($usuario);
   }
   public function editarUsuario2(Request $ia){
    $id=$ia->id;
    $name=$ia->nombre;
    $rol_user=$ia->rol;
    $contraseña=$ia->contraseña;
    $email=$ia->correo;
    //guardamos en la base de datos
    $usuario = usuarios::find($id);
    $usuario->name=$name;
    $usuario->id_rol=$rol_user;
    $usuario->email=$email;
    $usuario->password=$contraseña;
    $usuario->save();

   }
   public function editarContraseña(Request $ia){
    $id=$ia->id;
    $password=$ia->contraseña;
    $contraseña= Hash::make($password);
    $usuario = usuarios::find($id);
    $usuario->password=$contraseña;
    $usuario->save();
   }
   public function editarUsuario(Request $ia){
    $id=$ia->id;
    $name=$ia->nombre;
    $rol_user=$ia->rol;
    $email=$ia->correo;
   //guardamos en la base de datos
    $usuario = usuarios::find($id);
    $usuario->name=$name;
    $usuario->id_rol=$rol_user;
    $usuario->email=$email;
    $usuario->save();


   }
   public function guardarUsuario(Request $ia){
    $this->validate($ia,[
        'nombre'=>'required'
      ]);
      $name= $ia->nombre;
      $apellido_user=$ia->apellido;
      $rol_user=$ia->rol;
      $password=$ia->contraseña;
      $email=$ia->correo;
      $contraseña= Hash::make($password);

      $usuario= new usuarios();
       $usuario->name=$name." ".$apellido_user;
       $usuario->id_rol=$rol_user;
       $usuario->email=$email;
       $usuario->password=$contraseña;
       $usuario->save();
   }
   public function deleteUser(Request $idA){
    $id = $idA->id;
    $categoria = usuarios::destroy($id);
   }

  


}
