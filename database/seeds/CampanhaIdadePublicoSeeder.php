<?php

use Illuminate\Database\Seeder;

class CampanhaIdadePublicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\CampanhaIdadePublico::create([
            'campanha_id' => 1,
            'idade_id' => 2,
            'publico_id' => 1,
            'data_ini' => '2020-05-01',
            'data_end' => '2020-06-08',
        ]);

        \App\CampanhaIdadePublico::create([
            'campanha_id' => 1,
            'idade_id' => 3,
            'publico_id' => 1,
            'data_ini' => '2020-04-01',
            'data_end' => '2020-04-20',
        ]);

        \App\CampanhaIdadePublico::create([
            'campanha_id' => 2,
            'idade_id' => 2,
            'publico_id' => 2,
            'data_ini' => '2020-06-30',
            'data_end' => '2020-07-10',
        ]);

        \App\CampanhaIdadePublico::create([
            'campanha_id' => 2,
            'idade_id' => 3,
            'publico_id' => 2,
            'data_ini' => '2020-08-01',
            'data_end' => '2020-08-10',
        ]);

        \App\CampanhaIdadePublico::create([
            'campanha_id' => 1,
            'idade_id' => 1,
            'publico_id' => 2,
            'data_ini' => '2020-05-06',
            'data_end' => '2020-06-30',
        ]);

        \App\CampanhaIdadePublico::create([
            'campanha_id' => 3,
            'idade_id' => 3,
            'publico_id' => 3,
            'data_ini' => '2020-08-06',
            'data_end' => '2020-10-08',
        ]);
    }
}
