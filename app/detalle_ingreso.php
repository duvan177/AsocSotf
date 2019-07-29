<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detalle_ingreso extends Model
{
    protected $table = 'detalle_ingreso';
    protected $primaryKey = 'id_ingreso';


        public function persona()
{
       return $this->hasManyThrough('App\persona','App\ingreso','id','id','id_ingreso','id_proveedor');
    
}
public function Ingreso(){
    return $this->hasMany('App\ingreso','id');
}
public function articulo(){
    return $this->hasMany('App\articulo','id','id_articulo');
}


}
