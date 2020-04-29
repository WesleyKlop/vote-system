<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGridPropositionOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grid_proposition_options', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('proposition_id');
            $table->enum('vector', ['horizontal', 'vertical']);
            $table->string('option');

            $table
                ->foreign('proposition_id')
                ->references('id')
                ->on('propositions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grid_proposition_options');
    }
}
