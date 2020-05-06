<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentesSolicitacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agentes_solicitacoes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('solicitacao_id');
            $table->unsignedBigInteger('agente_id');
            $table->unsignedBigInteger('chiefAgent_id');

            $table->foreign('solicitacao_id')->references('id')->on('solicitacoes')->onDelete('cascade');
            $table->foreign('agente_id')->references('id')->on('agentes')->onDelete('cascade');
            $table->foreign('chiefAgent_id')->references('id')->on('agentes')->onDelete('cascade');
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
        Schema::dropIfExists('agentes_solicitacoes');
    }
}
