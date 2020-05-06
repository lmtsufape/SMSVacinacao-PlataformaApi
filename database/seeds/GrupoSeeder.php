<?php

use Illuminate\Database\Seeder;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Grupo::create([
            'nome' => 'idosos'
        ]);

        \App\Grupo::create([
            'nome' => 'crianças'
        ]);

        \App\Grupo::create([
            'nome' => 'Adolecentes'
        ]);
    }
}
