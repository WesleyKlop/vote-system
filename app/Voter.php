<?php

namespace App;

class Voter extends AbstractModel
{
    protected $fillable = [
        'token',
    ];

    public function answers()
    {
        return $this->hasMany(VoterPropositionOption::class);
    }
}
