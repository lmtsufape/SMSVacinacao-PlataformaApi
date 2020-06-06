<?php

use Illuminate\Database\Seeder;

class IdadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \App\Idade::create([
            'grupo' => 'Idoso',
            'idade_ini' => 40,
            'idade_end' => 60,
            'mes' => false,
        ]);

        \App\Idade::create([
            'grupo' => 'Criança',
            'idade_ini' => 8,
            'idade_end' => 12,
            'mes' => false,
        ]);

        \App\Idade::create([
            'grupo' => 'Adolecente',
            'idade_ini' => 10,
            'idade_end' => 20,
            'mes' => false,
        ]);
    }
}
