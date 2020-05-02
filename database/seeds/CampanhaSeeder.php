<?php

use Illuminate\Database\Seeder;

class CampanhaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('campanhas')->insert([  // 1
            'vacina_id' => 1,
            'publico_id' => 1,
            'segmento_id' => 1,
        ]);

        DB::table('campanhas')->insert([  // 1
            'vacina_id' => 1,
            'publico_id' => 2,
            'segmento_id' => 1,
        ]);
    }
}
