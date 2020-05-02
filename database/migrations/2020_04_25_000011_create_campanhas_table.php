<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampanhasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campanhas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('vacina_id');
            $table->unsignedBigInteger('publico_id');
            $table->unsignedBigInteger('segmento_id');

            $table->foreign('vacina_id')->references('id')->on('vacinas')->onDelete('cascade');
            $table->foreign('publico_id')->references('id')->on('publicos')->onDelete('cascade');
            $table->foreign('segmento_id')->references('id')->on('segmentos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('campanhas');
    }
}
