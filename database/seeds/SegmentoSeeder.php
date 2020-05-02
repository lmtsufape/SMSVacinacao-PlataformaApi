<?php

use Illuminate\Database\Seeder;

class SegmentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Segmento::create([
            'idade_id' => 2,
            'periodo_id' => 1,
        ]);
    }
}
