<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DevelopmentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DatabaseSeeder::class);
        $this->call(VoterSeeder::class);
        $this->call(PropositionSeeder::class);
    }
}
