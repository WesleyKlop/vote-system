<?php

namespace App\VoteSystem\Models;

/**
 * Class VoterPropositionOption
 * @package App\VoteSystem\Models
 * @property Voter $voter
 * @property Proposition $proposition
 * @property PropositionOption $verticalOption
 * @property PropositionOption $horizontalOption
 */
class VoterPropositionOption extends AbstractModel
{
    protected $fillable = [
        'voter_id',
        'proposition_id',
        'vertical_option_id',
        'horizontal_option_id',
    ];

    public function proposition()
    {
        return $this->belongsTo(Proposition::class);
    }

    public function voter()
    {
        return $this->belongsTo(Voter::class);
    }

    public function verticalOption()
    {
        return $this->belongsTo(PropositionOption::class, 'vertical_option_id');
    }

    public function horizontalOption()
    {
        return $this->belongsTo(
            PropositionOption::class,
            'horizontal_option_id'
        );
    }
}
