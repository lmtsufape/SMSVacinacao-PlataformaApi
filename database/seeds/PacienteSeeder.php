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
            'cns' => 718000314410004,
            'nome' => 'Marina Pereira Lima',
            'nasc' => date('Y-m-d'),
            'tel' => '87981486931',
            'rua' => 'Santa Fé',
            'num' => '126',
            'bairro' => 'Boa vista',
            'cidade' => 'Garanhuns',
            'uf' => 'PE',
            'cep' => '56555-000',
            'lat' => -8.987803,
            'lng' => -37.485048
        ]);

        \App\Paciente::create([
            'cns' => 991514158060008,
            'nome' => 'Vinicius Martins Cardoso',
            'nasc' => date('Y-m-d'),
            'tel' => '87981486931',
            'rua' => 'Colônia Agrícola Vicente Pires',
            'num' => '126',
            'bairro' => 'Centro',
            'cidade' => 'Garanhuns',
            'uf' => 'PE',
            'cep' => '56555-000',
            'lat' => -8.987868,
            'lng' => -37.487304
        ]);

        \App\Paciente::create([
            'cns' => 288354864860002,
            'nome' => 'Thiago Castro Ribeiro',
            'nasc' => date('Y-m-d'),
            'tel' => '87981486931',
            'rua' => 'Rua Nove',
            'num' => '126',
            'complemento' => 'casa',
            'bairro' => 'Aloisio Souto Pinto',
            'cidade' => 'Garanhuns',
            'uf' => 'PE',
            'cep' => '56555-000',
            'lat' => -8.985219,
            'lng' => -37.486392
        ]);

        \App\Paciente::create([
            'cns' => 764541936590006,
            'nome' => 'João Marques Silva',
            'nasc' => date('Y-m-d'),
            'tel' => '87981486931',
            'rua' => 'Av Rui Barbosa',
            'num' => '100',
            'complemento' => 'casa',
            'bairro' => 'Boa vista',
            'cidade' => 'Garanhuns',
            'uf' => 'PE',
            'cep' => '56555-000',
            'lat' => -8.985219,
            'lng' => -37.486392
        ]);
    }
}
