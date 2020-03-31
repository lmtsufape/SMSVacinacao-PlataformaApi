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
            'atend_domic' => true,
        ]);

        \App\Campanha::create([
            'nome' => 'Covid-19',
            'desc' => 'bleu bleu',
            'idade_ini' => 50,
            'idade_end' => 80,
            'atend_domic' => true,
        ]);
    }
}
