<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoterPropositionOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voter_proposition_options', function (
            Blueprint $table
        ) {
            $table->uuid('id')->primary();
            $table->uuid('proposition_id');
            $table->uuid('voter_id');
            $table->uuid('horizontal_option_id');
            $table->uuid('vertical_option_id');

            $table
                ->foreign('proposition_id')
                ->references('id')
                ->on('propositions');
            $table
                ->foreign('voter_id')
                ->references('id')
                ->on('voters');
            $table
                ->foreign('horizontal_option_id')
                ->references('id')
                ->on('proposition_options');
            $table
                ->foreign('vertical_option_id')
                ->references('id')
                ->on('proposition_options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voter_proposition_options');
    }
}
