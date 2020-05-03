<?php

namespace App\VoteSystem\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class Proposition extends AbstractModel
{
    protected $fillable = ['title', 'is_open', 'type', 'order'];

    public function scopeOpen(Builder $query)
    {
        return $query->where('is_open', true);
    }

    public function options()
    {
        return $this->hasMany(PropositionOption::class);
    }

    public function verticalOptions(): Collection
    {
        return $this->options->where('axis', 'vertical');
    }

    public function horizontalOptions(): Collection
    {
        return $this->options->where('axis', 'horizontal');
    }

    public function voters()
    {
        return $this->hasManyThrough(Voter::class, VoterPropositionOption::class, 'proposition_id', 'id', 'id', 'voter_id');
    }

    public function answers()
    {
        return $this->hasMany(VoterPropositionOption::class);
    }
}
