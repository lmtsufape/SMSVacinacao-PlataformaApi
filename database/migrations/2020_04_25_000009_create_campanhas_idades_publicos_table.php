<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampanhasIdadesPublicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campanhas_idades_publicos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('campanha_id');
            $table->unsignedBigInteger('idade_id');
            $table->unsignedBigInteger('publico_id');
            $table->date('data_ini');
            $table->date('data_end');

            $table->foreign('campanha_id')->references('id')->on('campanhas')->onDelete('cascade');
            $table->foreign('idade_id')->references('id')->on('idades')->onDelete('cascade');
            $table->foreign('publico_id')->references('id')->on('publicos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campanhas_idades_publicos');
    }
}
