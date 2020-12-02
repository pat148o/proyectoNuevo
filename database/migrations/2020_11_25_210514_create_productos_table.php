<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo',50);
            $table->string('nombre',80);
            $table->string('cant',25);
            $table->decimal('precio',11,2);
            $table->decimal('prec_venta',11,2);

            $table->integer('id_tipo_producto')->unsigned();
            $table->foreign('id_tipo_producto')->references('id')->on('tipo_productos');

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
        Schema::dropIfExists('productos');
    }
}
