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
            'data_ini' => Date('Y-m-d'),
            'data_end' => Date('Y-m-d'),
        ]);

        \App\CampanhaIdadePublico::create([
            'campanha_id' => 2,
            'idade_id' => 2,
            'publico_id' => 2,
            'data_ini' => Date('Y-m-d'),
            'data_end' => Date('Y-m-d'),
        ]);

        \App\CampanhaIdadePublico::create([
            'campanha_id' => 1,
            'idade_id' => 2,
            'publico_id' => 2,
            'data_ini' => Date('Y-m-d'),
            'data_end' => Date('Y-m-d'),
        ]);

        \App\CampanhaIdadePublico::create([
            'campanha_id' => 1,
            'idade_id' => 2,
            'publico_id' => 1,
            'data_ini' => Date('Y-m-d'),
            'data_end' => Date('Y-m-d'),
        ]);
    }
}
