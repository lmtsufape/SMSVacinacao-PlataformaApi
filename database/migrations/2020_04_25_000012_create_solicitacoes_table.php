<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacoes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('campanha_idade_publico_id');
            $table->string('paciente_cns');
            $table->unsignedBigInteger('agente_id')->nullable();
            $table->string('status')->default('Em Analise');
            $table->text('recusa_desc')->nullable();
            $table->dateTime('data_time')->nullable();

            $table->unique(['paciente_cns', 'campanha_idade_publico_id']);

            $table->foreign('campanha_idade_publico_id')->references('id')->on('campanhas_idades_publicos')->onDelete('cascade');
            $table->foreign('paciente_cns')->references('cns')->on('pacientes')->onDelete('cascade');
            $table->foreign('agente_id')->references('id')->on('agentes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitacoes');
    }
}
