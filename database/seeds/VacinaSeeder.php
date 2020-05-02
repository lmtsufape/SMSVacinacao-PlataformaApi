<?php

use Illuminate\Database\Seeder;

class VacinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \App\Vacina::create([
            'termo_id' => 1,
            'nome' => 'H1N1',
            'desc' => 'h1n1 ...',
            'atend_domic' => false,

        ]);

        \App\Vacina::create([
            'termo_id' => 1,
            'nome' => 'Covid-19',
            'desc' => 'covid....',
            'atend_domic' => false,

        ]);

        \App\Vacina::create([
            'termo_id' => 2,
            'nome' => 'Covid-19',
            'desc' => 'covid....',
            'atend_domic' => true,

        ]);
    }
}
