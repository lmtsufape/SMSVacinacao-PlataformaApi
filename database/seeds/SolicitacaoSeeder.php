<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SolicitacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('solicitacoes')->insert([  // 1
            'campanha_id' => 1,
            'paciente_cns' => '1231231232',
            'status' => 'Em espera',
        ]);

        DB::table('solicitacoes')->insert([  // 1
            'campanha_id' => 2,
            'paciente_cns' => '1231231232',
            'agente_id' => 1,
            'status' => 'vacinado',
            'data_time' => new DateTime('now'),
        ]);

        DB::table('solicitacoes')->insert([  // 1
            'campanha_id' => 2,
            'paciente_cns' => '1231231234',
            'agente_id' => 1,
            'status' => 'recusado',
            'recusa_desc' => 'foi recusado por está...',
            'data_time' => new DateTime('now'),
        ]);

        DB::table('solicitacoes')->insert([  // 1
            'campanha_id' => 2,
            'paciente_cns' => '1231231233',
            'agente_id' => 1,
            'status' => 'Em espera',
            'data_time' => new DateTime('now'),
        ]);
    }
}
