<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class fechaController extends Controller
{
        public function traer_fecha(){
      
      $date = Carbon::now();
 
      
      $data = $date->format('d-m-y');    

return response()->json($data);
        

    }
    public function NumeroFactura(){

             $data = DB::table('venta')
             ->select( 'id')
             ->max('id');

             if ($data == null) {
               
              $notif = 404;
                return response()->json($notif);
              
             }else {
                return response()->json($data, 200);
               
             }    
    }
}
