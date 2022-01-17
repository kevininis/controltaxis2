<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->decimal('monto', 12, 2);
            $table->string('observaciones', 500);
            $table->integer('id_tipo_gasto')->unsigned();
            $table->foreign('id_tipo_gasto')->references('id')->on('tipo_gastos');
            $table->integer('id_taxi')->unsigned();
            $table->foreign('id_taxi')->references('id')->on('taxis');
            $table->integer('id_chofer')->unsigned();
            $table->foreign('id_chofer')->references('id')->on('chofers');
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
        Schema::dropIfExists('gastos');
    }
}
