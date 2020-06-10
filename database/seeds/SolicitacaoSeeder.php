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
        \App\Solicitacao::create([  // 1
            'campanha_idade_publico_id' => 1,
            'paciente_cns' => '718000314410004',
        ]);

        \App\Solicitacao::create([  // 1
            'campanha_idade_publico_id' => 8,
            'paciente_cns' => '718000314410004',
        ]);

        \App\Solicitacao::create([  // 1
            'campanha_idade_publico_id' => 3,
            'paciente_cns' => '991514158060008',
        ]);

        \App\Solicitacao::create([  // 1
            'campanha_idade_publico_id' => 5,
            'paciente_cns' => '288354864860002',
        ]);

        \App\Solicitacao::create([  // 1
            'campanha_idade_publico_id' => 5,
            'paciente_cns' => '764541936590006',
        ]);
    }
}
