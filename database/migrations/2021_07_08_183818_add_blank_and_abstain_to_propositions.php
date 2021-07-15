<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBlankAndAbstainToPropositions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('propositions', function (Blueprint $table) {
            $table
                ->foreignUuid('abstain_option_id')
                ->nullable()
                ->references('id')
                ->on('proposition_options')
                ->nullOnDelete();
            $table
                ->foreignUuid('blank_option_id')
                ->nullable()
                ->references('id')
                ->on('proposition_options')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('propositions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('abstain_option_id');
            $table->dropConstrainedForeignId('blank_option_id');
        });
    }
}
