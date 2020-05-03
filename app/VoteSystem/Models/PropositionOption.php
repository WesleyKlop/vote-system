<?php

namespace App\VoteSystem\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class PropositionOption
 * @package App\VoteSystem\Models
 * @property string $axis
 * @property string $option
 * @property Proposition $proposition
 */
class PropositionOption extends AbstractModel
{
    protected $fillable = ['axis', 'option'];

    public function proposition(): BelongsTo
    {
        return $this->belongsTo(Proposition::class);
    }

    public function scopeVertical(Builder $query): Builder
    {
        return $query->where('axis', 'vertical');
    }

    public function scopeHorizontal(Builder $query): Builder
    {
        return $query->where('axis', 'horizontal');
    }
}
