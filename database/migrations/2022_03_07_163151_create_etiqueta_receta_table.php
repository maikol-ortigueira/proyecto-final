<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtiquetaRecetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etiqueta_receta', function (Blueprint $table) {
            $table->primary(['etiqueta_id', 'receta_id']);
            $table->bigInteger('etiqueta_id')->unsigned();
            $table->bigInteger('receta_id')->unsigned();
            $table->foreign('etiqueta_id')
                ->references('id')
                ->on('etiquetas')
                ->onDelete('cascade');
            $table->foreign('receta_id')
                ->references('id')
                ->on('recetas')
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
        Schema::dropIfExists('etiqueta_receta');
    }
}
