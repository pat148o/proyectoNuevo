<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_salidas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cant',25);

            $table->integer('id_producto')->unsigned();
            $table->integer('id_sali_producto')->unsigned();

            $table->foreign('id_producto')->references('id')->on('productos');
            $table->foreign('id_sali_producto')->references('id')->on('sali_productos');
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
        Schema::dropIfExists('det_salidas');
    }
}
