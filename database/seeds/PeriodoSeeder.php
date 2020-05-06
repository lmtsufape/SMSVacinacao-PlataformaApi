<?php

use Illuminate\Database\Seeder;

class PeriodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Periodo::create([
            'data_ini' => Date('Y-m-d'),
            'data_end' => Date('Y-m-d'),
        ]);
    }
}
