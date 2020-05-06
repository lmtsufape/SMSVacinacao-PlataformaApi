<?php

use Illuminate\Database\Seeder;

class CampanhaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('campanhas')->insert([  // 1
            'termo_id' => 2,
            'nome' => 'H1N1',
            'desc' => 'A gripe suína foi reconhecida pela primeira vez na pandemia de 1919 e ainda circula como um vírus da gripe sazonal. A gripe suína é causada pela cepa de vírus H1N1, que começou em porcos. Os sintomas incluem febre, tosse, dor de garganta, calafrios e dores no corpo.',
            'atend_domic' => false,
            'data_ini' => '2020-05-06',
            'data_end' => '2020-06-08',
        ]);

        DB::table('campanhas')->insert([  // 1
            'termo_id' => 1,
            'nome' => 'Covid-19',
            'desc' => 'Ele causa problemas respiratórios semelhantes à gripe e sintomas como tosse, febre e, em casos mais graves, dificuldade para respirar. Como prevenção, lave as mãos com frequência e evite tocar o rosto e ter contato próximo (um metro de distância) com pessoas que não estejam bem.',
            'atend_domic' => false,
            'data_ini' => '2020-06-30',
            'data_end' => '2020-08-10',
        ]);

        DB::table('campanhas')->insert([  // 1
            'termo_id' => 1,
            'nome' => 'Malaria',
            'desc' => 'A gravidade da malária varia de acordo com a espécie de Plasmodium. Os sintomas são calafrios, febre e sudorese, ocorrendo geralmente algumas semanas depois da picada. Geralmente, pessoas que viajam para áreas onde a malária é comum tomam remédios preventivos antes, durante e depois da viagem. O tratamento inclui medicamentos antimaláricos.',
            'atend_domic' => true,
            'data_ini' => '2020-10-01',
            'data_end' => '2020-11-23',
        ]);
    }
}
