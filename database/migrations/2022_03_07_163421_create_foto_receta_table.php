<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoRecetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_receta', function (Blueprint $table) {
            $table->primary(['foto_id', 'receta_id']);
            $table->bigInteger('foto_id')->unsigned();
            $table->bigInteger('receta_id')->unsigned();
            $table->foreign('foto_id')
                ->references('id')
                ->on('fotos')
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
        Schema::dropIfExists('foto_receta');
    }
}
