<?php

use Illuminate\Database\Seeder;

class VacinaUnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('vacinas_unidades')->insert([  // 1
            'vacina_id' => 1,
            'unidade_id' => 1,
        ]);

        DB::table('vacinas_unidades')->insert([  // 1
            'vacina_id' => 1,
            'unidade_id' => 2,
        ]);

        DB::table('vacinas_unidades')->insert([  // 1
            'vacina_id' => 1,
            'unidade_id' => 3,
        ]);

        DB::table('vacinas_unidades')->insert([  // 1
            'vacina_id' => 1,
            'unidade_id' => 4,
        ]);
    }
}
