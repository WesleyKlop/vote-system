<?php

use App\Models\AppConfig;
use Database\Seeders\AppConfigSeeder;
use Illuminate\Database\Migrations\Migration;

class SeedApplicationConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $seeder = new AppConfigSeeder();

        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        AppConfig::truncate();
    }
}
