<?php

use Illuminate\Database\Seeder;

class PacienteSeeder extends Seeder
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
            'cns' => 111111111111111,
            'nome' => 'Luiz caldas',
            'nasc' => date('Y-m-d'),
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
            'cns' => 222222222222222,
            'nome' => 'Ermanoteu',
            'nasc' => date('Y-m-d'),
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
            'cns' => 333333333333333,
            'nome' => 'Seu lunga',
            'nasc' => date('Y-m-d'),
            'tel' => '87981486931',
            'rua' => 'luiz mendes',
            'num' => '126',
            'complemento' => 'casa',
            'bairro' => 'Aloisio Souto Pinto',
            'cidade' => 'garanhuns',
            'uf' => 'PE',
            'cep' => '56555-000',
            'lat' => -8.985219,
            'lng' => -37.486392
        ]);
    }
}
