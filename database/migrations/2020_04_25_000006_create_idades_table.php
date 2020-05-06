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
            $table->string('grupo');
            $table->integer('idade_ini');
            $table->integer('idade_end');
            $table->boolean('mes');
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
