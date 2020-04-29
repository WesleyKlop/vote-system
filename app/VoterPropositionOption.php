<?php

namespace App;

class VoterPropositionOption extends AbstractModel
{
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
