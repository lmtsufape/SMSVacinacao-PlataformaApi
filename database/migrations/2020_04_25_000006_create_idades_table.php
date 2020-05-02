<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idades', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('grupo_id');
            $table->integer('idade_ini');
            $table->integer('idade_end');
            $table->boolean('mes');

            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('idades');
    }
}
