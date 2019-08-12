<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detalle_venta extends Model
{
    protected $table = 'detalle_venta';
      protected $primaryKey = 'id_ingreso';
    
    

      public function articulo()
    {
        return $this->hasMany('App\articulo','id','id_articulo');
    }

    public function categoria(){
      
       return $this->hasManyThrough('App\detalle_venta','App\articulo','id','id','id_categoria','id_articulo');
     
    }
}
