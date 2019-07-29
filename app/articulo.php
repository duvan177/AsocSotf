<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class articulo extends Model
{
    protected $table = 'articulo';
    
    protected $fillable = ['id','id_categoria','codigo','nombre','stock','descripcion','estado'];
  
}
