<?php

use Illuminate\Database\Migrations\Migration;

class CloseAllPropositions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        \App\Models\Proposition::query()->update([
            'is_open' => false
        ]);
    }
}
