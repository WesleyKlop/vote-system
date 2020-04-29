<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListPropositionOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_proposition_options', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('proposition_id');
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
        Schema::dropIfExists('list_proposition_options');
    }
}
