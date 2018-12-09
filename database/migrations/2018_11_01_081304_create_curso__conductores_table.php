<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursoConductoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso__conductores', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('curso_id');
            $table->foreign('curso_id')->references('id')->on('cursos');
            $table->unsignedInteger('conductor_id');
            $table->foreign('conductor_id')->references('id')->on('conductores');
            $table->string('carnet',12);
            $table->date('fecha_ingreso');
            $table->date('fecha_vence');
            $table->unsignedInteger('empresa_transporte_id');
            $table->foreign('empresa_transporte_id')->references('id')->on('empresa_transportes');
            $table->softDeletes();
            $table->timestamps();
            $table->unique('conductor_id', 'carnet');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curso__conductores');
    }
}
