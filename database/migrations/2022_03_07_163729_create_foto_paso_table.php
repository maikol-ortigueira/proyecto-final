<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoPasoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_paso', function (Blueprint $table) {
            $table->primary(['foto_id', 'paso_id']);
            $table->bigInteger('foto_id')->unsigned();
            $table->bigInteger('paso_id')->unsigned();
            $table->foreign('foto_id')
                ->references('id')
                ->on('fotos')
                ->onDelete('cascade');
            $table->foreign('paso_id')
                ->references('id')
                ->on('pasos')
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
        Schema::dropIfExists('foto_paso');
    }
}
