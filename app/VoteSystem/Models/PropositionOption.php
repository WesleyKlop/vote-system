<?php

namespace App\VoteSystem\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropositionOption extends AbstractModel
{
    protected $fillable = ['axis', 'option'];

    public function proposition(): BelongsTo
    {
        return $this->belongsTo(Proposition::class);
    }

    public function scopeVertical(Builder $query)
    {
        return $query->where('axis', 'vertical');
    }

    public function scopeHorizontal(Builder $query)
    {
        return $query->where('axis', 'horizontal');
    }
}
