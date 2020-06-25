<?php

use App\VoteSystem\Models\AppConfig;
use Illuminate\Database\Seeder;

class AppConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppConfig::insert([
            ['name' => 'welcome_message', 'default' => 'Welcome to this voting application! Please enter the token you\'ve been given to start.'],
            ['name' => 'admin_welcome_message', 'default' => 'Welcome to the admin part of the voting app!'],
            ['name' => 'logo_url', 'default' => '/images/logo.svg'],
        ]);
    }
}
