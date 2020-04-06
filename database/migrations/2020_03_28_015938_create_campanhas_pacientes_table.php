<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampanhasPacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campanhas_pacientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campanha_id');
            $table->string('paciente_cns');
            $table->unsignedBigInteger('agente_id')->nullable();
            $table->boolean('vacinado')->nullable();
            $table->dateTime('data_time')->nullable();

            $table->foreign('campanha_id')->references('id')->on('campanhas');
            $table->foreign('paciente_cns')->references('cns')->on('pacientes');
            $table->foreign('agente_id')->references('id')->on('agentes');

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
        Schema::dropIfExists('campanhas_pacientes');
    }
}
