<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropositionOption extends AbstractModel
{
    protected $fillable = [
        'vector',
        'option',
    ];

    public function proposition(): BelongsTo
    {
        return $this->belongsTo(Proposition::class);
    }

    public function scopeVertical(Builder $query)
    {
        return $query->where('vector', 'vertical');
    }

    public function scopeHorizontal(Builder $query)
    {
        return $query->where('vector', 'horizontal');
    }
}
