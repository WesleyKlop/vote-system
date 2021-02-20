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
        $this->assertAppConfigsExist([
            ['name' => 'welcome_message', 'default' => <<<'HTML'
Welcome to this voting application!
Please enter the token you've been given to start.
HTML],
            ['name' => 'admin_welcome_message', 'default' => 'Welcome to the admin part of the voting app!', ],
            ['name' => 'voter_legal_requirements', 'default' => <<<'HTML'
I declare that the filled in token is mine;
I am a valid member of this association;
I will not cast my vote more than once.
HTML],
            ['name' => 'logo_url', 'default' => null],
            ['name' => 'primary_color', 'default' => null],
            ['name' => 'accent_color', 'default' => null],
            ['name' => 'language', 'default' => null],
        ]);
    }

    private function assertAppConfigsExist(array $configOptions): void
    {
        foreach ($configOptions as $config) {
            AppConfig::updateOrInsert(
                ['name' => $config['name']],
                ['default' => $config['default']],
            );
        }
    }
}
