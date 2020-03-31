<?php

use Illuminate\Database\Seeder;

class PacientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \App\Paciente::create([
            'cns' => 1231231232,
            'nome' => 'Luiz caldas',
            'nasc' => new DateTime('now'),
            'tel' => '87981486931',
            'rua' => 'luiz mendes',
            'num' => '126',
            'bairro' => 'Aloisio Souto Pinto',
            'cidade' => 'garanhuns',
            'uf' => 'PE',
            'cep' => '56555-000',
            'lat' => -8.987803,
            'lng' => -37.485048
        ]);

        \App\Paciente::create([
            'cns' => 1231231233,
            'nome' => 'Pararatimbun',
            'nasc' => new DateTime('now'),
            'tel' => '87981486931',
            'rua' => 'luiz mendes',
            'num' => '126',
            'bairro' => 'Aloisio Souto Pinto',
            'cidade' => 'garanhuns',
            'uf' => 'PE',
            'cep' => '56555-000',
            'lat' => -8.987868,
            'lng' => -37.487304
        ]);

        \App\Paciente::create([
            'cns' => 1231231234,
            'nome' => 'fiurino',
            'nasc' => new DateTime('now'),
            'tel' => '87981486931',
            'rua' => 'luiz mendes',
            'num' => '126',
            'bairro' => 'Aloisio Souto Pinto',
            'cidade' => 'garanhuns',
            'uf' => 'PE',
            'cep' => '56555-000',
            'lat' => -8.985219,
            'lng' => -37.486392
        ]);
    }
}
