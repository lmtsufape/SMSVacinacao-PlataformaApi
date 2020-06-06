<?php

use Illuminate\Database\Seeder;

class AgenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('agentes')->insert([  // 1
            'email' => 'admin@gmail.com',
            'cpf' => '54527952781',
            'password' => bcrypt('12345678'),
            'nome' => 'Amanda Costa Fernandes',
            'cidade' => 'Garanhuns',
            'uf' => 'PE',
            'admin' => true,
        ]);

        DB::table('agentes')->insert([  // 1
            'email' => 'agente@gmail.com',
            'cpf' => '77606790175',
            'password' => bcrypt('12345678'),
            'nome' => 'Danilo Gomes Alves',
            'cidade' => 'Garanhuns',
            'uf' => 'PE',
        ]);
    }
}
