<?php

use Illuminate\Database\Seeder;

class AgentesTableSeeder extends Seeder
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
            'email' => 'luancsl95@gmail.com',
            'cpf' => '10818110481',
            'password' => bcrypt('12345678'),
            'nome' => 'Fulando',
            'cidade' => 'garanhuns',
            'uf' => 'PE',
        ]);
    }
}
