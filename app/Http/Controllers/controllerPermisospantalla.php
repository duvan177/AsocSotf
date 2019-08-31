<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class controllerPermisospantalla extends Controller
{
    public function getDataPermise(Request $ia){
        $id = $ia->id;
        //print_r($id);
        $roll= DB::table('users')
        ->select('users.id_rol')
        ->where('users.id','=',$id)
        ->get();
      
        return response()->json($roll);
    }
}
