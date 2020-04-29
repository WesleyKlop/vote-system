<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class Proposition extends AbstractModel
{
    protected $fillable = [
        'title',
        'is_open',
        'type',
        'order',
    ];

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
        return $this->options->where('vector', 'vertical');
    }

    public function horizontalOptions(): Collection
    {
        return $this->options->where('vector', 'horizontal');
    }

    public function voters()
    {
        return $this->belongsToMany(Voter::class, 'voter_proposition_options');
    }

    public function answers()
    {
        return $this->hasMany(VoterPropositionOption::class);
    }
}
