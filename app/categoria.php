<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    protected $table = 'categoria';
    protected $fillable = ['id','nombre_categoria','descripcion_categoria'];
  
}