<?php

use Illuminate\Database\Seeder;

class CampanhaUnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('campanhas_unidades')->insert([  // 1
            'campanha_id' => 1,
            'unidade_id' => 1,
        ]);

        DB::table('campanhas_unidades')->insert([  // 1
            'campanha_id' => 1,
            'unidade_id' => 2,
        ]);

        DB::table('campanhas_unidades')->insert([  // 1
            'campanha_id' => 1,
            'unidade_id' => 3,
        ]);

        DB::table('campanhas_unidades')->insert([  // 1
            'campanha_id' => 1,
            'unidade_id' => 4,
        ]);
    }
}
