<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cant',25);
            $table->decimal('valor_unit',11,2);


            $table->integer('id_factura')->unsigned();
            $table->integer('id_pedido')->unsigned();

            $table->foreign('id_factura')->references('id')->on('facturas'); 
            $table->foreign('id_pedido')->references('id')->on('pedidos');
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
        Schema::dropIfExists('det_facturas');
    }
}
