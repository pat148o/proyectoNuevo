<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cant');
            $table->decimal('valor_unit',11,2);
            $table->decimal('valor_total',11,2);
      
            $table->integer('id_pedido')->unsigned();
            $table->integer('id_producto')->unsigned();
            $table->foreign('id_pedido')->references('id')->on('pedidos'); 
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
        Schema::dropIfExists('det_pedidos');
    }
}
