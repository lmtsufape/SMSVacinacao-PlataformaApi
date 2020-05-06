<?php

use Illuminate\Database\Seeder;

class TermoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \App\Termo::create([
            'nome' => 'covid',
            'desc' => 'voce aceita covid....',
        ]);

        \App\Termo::create([
            'nome' => 'h1n1',
            'desc' => 'voce aceita h1n1....',
        ]);
    }
}
