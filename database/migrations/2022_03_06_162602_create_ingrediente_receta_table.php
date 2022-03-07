<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredienteRecetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingrediente_receta', function (Blueprint $table) {
            $table->bigInteger('ingrediente_id')->unsigned();
            $table->primary(['ingrediente_id', 'receta_id']);
            $table->bigInteger('receta_id')->unsigned();
            $table->foreign('ingrediente_id')
            ->references('id')
            ->on('ingredientes')
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
        Schema::dropIfExists('ingrediente_receta');
    }
}
