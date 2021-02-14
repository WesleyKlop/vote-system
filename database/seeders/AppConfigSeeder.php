<?php
namespace Database\Seeders;

use App\Models\AppConfig;
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
            [
                'name' => 'welcome_message',
                'default' =>
                    'Welcome to this voting application! Please enter the token you\'ve been given to start.',
            ],
            [
                'name' => 'admin_welcome_message',
                'default' => 'Welcome to the admin part of the voting app!',
            ],
            [
                'name' => 'voter_legal_requirements',
                'default' =>
                    'I declare that the filled in token is mine;<br />I am a participating member of this association;<br />I will not cast my vote more than once.',
            ],
            ['name' => 'logo_url', 'default' => null],
            ['name' => 'primary_color', 'default' => null],
            ['name' => 'accent_color', 'default' => null],
        ]);
    }
}
