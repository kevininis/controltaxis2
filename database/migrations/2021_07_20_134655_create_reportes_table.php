<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->decimal('ingresos');
            $table->decimal('gastos');
            $table->decimal('ingresos_chofer');
            $table->decimal('gastos_chofer');
            $table->decimal('ingresos_taxi');
            $table->decimal('gastos_taxi');
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
        Schema::dropIfExists('reportes');
    }
}
