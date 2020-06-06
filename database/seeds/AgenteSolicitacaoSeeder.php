<?php

use Illuminate\Database\Seeder;

class AgenteSolicitacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('agentes_solicitacoes')->insert([  // 1
            'solicitacao_id' => 1,
            'agente_id' => 2,
            'chiefAgent_id' => 1,
        ]);
        DB::table('agentes_solicitacoes')->insert([  // 1
            'solicitacao_id' => 3,
            'agente_id' => 2,
            'chiefAgent_id' => 1,
        ]);
    }
}
