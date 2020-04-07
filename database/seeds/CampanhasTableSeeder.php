<?php

use Illuminate\Database\Seeder;

class CampanhasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \App\Campanha::create([
            'nome' => 'H1N1',
            'desc' => 'bleu bleu',
            'idade_ini' => 20,
            'idade_end' => 30,
            'data_ini' => date('Y-m-d'),
            'data_end' => date('Y-m-d'),
            'atend_domic' => false,
        ]);

        \App\Campanha::create([
            'nome' => 'Covid-19',
            'desc' => 'bleu bleu',
            'idade_ini' => 50,
            'idade_end' => 80,
            'data_ini' => date('Y-m-d'),
            'data_end' => date('Y-m-d'),
            'atend_domic' => true,
        ]);
    }
}
