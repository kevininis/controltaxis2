<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChofersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chofers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 45);
            $table->string('apellido', 45);
            $table->bigInteger('dpi');
            $table->date('fecha_nacimiento');
            $table->bigInteger('numero_documento');
            $table->string('tipo_licencia', 1);
            $table->date('vencimiento_licencia');
            $table->string('tipo_sangre', 4);
            $table->string('restricciones', 500);
            $table->integer('id_estado')->unsigned();
            $table->foreign('id_estado')->references('id')->on('estados');
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
        Schema::dropIfExists('chofers');
    }
}
