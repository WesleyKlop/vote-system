<?php

use App\Models\Proposition;
use Illuminate\Database\Migrations\Migration;

class CloseAllPropositions extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Proposition::query()->update([
            'is_open' => false
        ]);
    }
}
