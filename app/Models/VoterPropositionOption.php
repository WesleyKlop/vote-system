<?php

namespace App\Models;

class VoterPropositionOption extends AbstractModel
{
    public final const UPDATED_AT = null;
    public $timestamps = true;

    protected $fillable = [
        'voter_id',
        'proposition_id',
        'vertical_option_id',
        'horizontal_option_id',
    ];

    protected $hidden = [
        'id',
        'voter_id',
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
