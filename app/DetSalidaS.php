<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetSalidaS extends Model
{
    //
    protected $table ='det_salidas';
    protected $fillable=['id','cant','id_producto','id_sali_producto'];
    public $timestamps=false;
}

