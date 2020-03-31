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
        $this->call(AgentesTableSeeder::class);
        $this->call(PacientesTableSeeder::class);
        $this->call(CampanhasTableSeeder::class);
        $this->call(UnidadesTableSeeder::class);
        $this->call(CampanhasPacientesTableSeeder::class);
        $this->call(CampanhasUnidadesTableSeeder::class);
    }
}
