<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampanhasUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campanhas_unidades', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('campanha_id');
            $table->unsignedBigInteger('unidade_id');

            $table->foreign('campanha_id')->references('id')->on('campanhas')->onDelete('cascade');
            $table->foreign('unidade_id')->references('id')->on('unidades')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campanhas_unidades');
    }
}
