<?php

use Illuminate\Database\Seeder;

class PublicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \App\Publico::create([
            'nome' => 'Professores'
        ]);

        \App\Publico::create([
            'nome' => 'Presidiarios'
        ]);

        \App\Publico::create([
            'nome' => 'Indigenas'
        ]);

        \App\Publico::create([
            'nome' => 'Publico Geral'
        ]);
    }
}
