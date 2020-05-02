<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AgenteSeeder::class);
        $this->call(PacienteSeeder::class);
        $this->call(IdadeSeeder::class);
        $this->call(SegmentoSeeder::class);
        $this->call(UnidadeSeeder::class);
        $this->call(TermoSeeder::class);
        $this->call(CampanhaSeeder::class);
        $this->call(SolicitacaoSeeder::class);
        $this->call(VacinaUnidadeSeeder::class);
        $this->call(AgenteSolicitacaoSeeder::class);
    }
}
