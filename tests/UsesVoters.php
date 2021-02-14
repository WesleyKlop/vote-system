<?php

namespace Tests;

use App\Models\Voter;

trait UsesVoters
{
    protected function voter(): Voter
    {
        return Voter::factory()->create();
    }
}
