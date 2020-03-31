<?php

use Illuminate\Database\Seeder;

class CampanhasPacientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('campanhas_pacientes')->insert([  // 1
            'campanha_id' => 2,
            'paciente_cns' => 1231231232,
            'agente_cpf' => '10818110481',
            'vacinado' => false,
            'data_time' => new DateTime('now'),
        ]);
    }
}
