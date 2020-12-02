<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prov_productos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_proveedor')->unsigned();
            $table->integer('id_producto')->unsigned();
            $table->foreign('id_proveedor')->references('id')->on('proveedores');
            $table->foreign('id_producto')->references('id')->on('productos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prov_productos');
    }
}
