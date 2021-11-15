<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DevelopmentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(VoterSeeder::class);
        $this->call(PropositionSeeder::class);

        User::updateOrCreate(
            ['name' => 'admin'],
            ['password' => Hash::make('password')]
        );
    }
}
