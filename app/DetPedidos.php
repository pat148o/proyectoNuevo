<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetPedidos extends Model
{
    //
    protected $table ='det_pedidos';
    protected $fillable=['id','cant','valor_unit','valor_total','id_pedido','id_producto'];
    public $timestamps=false;
}
