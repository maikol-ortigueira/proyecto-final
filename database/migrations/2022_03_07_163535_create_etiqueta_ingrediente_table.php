<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtiquetaIngredienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etiqueta_ingrediente', function (Blueprint $table) {
            $table->primary(['etiqueta_id', 'ingrediente_id']);
            $table->bigInteger('etiqueta_id')->unsigned();
            $table->bigInteger('ingrediente_id')->unsigned();
            $table->foreign('etiqueta_id')
                ->references('id')
                ->on('etiquetas')
                ->onDelete('cascade');
            $table->foreign('ingrediente_id')
                ->references('id')
                ->on('ingredientes')
                ->onDelete('cascade');
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
        Schema::dropIfExists('etiqueta_ingrediente');
    }
}
