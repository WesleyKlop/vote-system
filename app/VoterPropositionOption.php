<?php

namespace App;

class VoterPropositionOption extends AbstractModel
{
    protected $fillable = [
        'voter_id',
        'proposition_id',
        'proposition_option_id',
    ];

    public function proposition()
    {
        return $this->belongsTo(Proposition::class);
    }

    public function voter()
    {
        return $this->belongsTo(Voter::class);
    }

    public function propositionOption()
    {
        return $this->belongsTo(PropositionOption::class);
    }
}
