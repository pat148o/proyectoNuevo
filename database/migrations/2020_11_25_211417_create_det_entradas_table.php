<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_entradas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fec_venci');
            $table->string('cant',25);

            $table->integer('id_producto')->unsigned();
            $table->integer('id_ent_producto')->unsigned();
            $table->foreign('id_producto')->references('id')->on('productos');
            $table->foreign('id_ent_producto')->references('id')->on('ent_productos');
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
        Schema::dropIfExists('det_entradas');
    }
}
