<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
     //

     protected $table ='users';
     protected $fillable=['id','name','email','password'];
     public $timestamps=false;
     
}


//se utiliza cuando no se crea el modelo por las migraciones.
//protected $table ='det_solicitudes';
//protected $fillable=['id','id_solicitudes','id_libros','cant'];
//public $timestamps=false;
