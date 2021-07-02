<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class PropositionOption.
 * @property string $axis
 * @property string $option
 * @property Proposition $proposition
 */
class PropositionOption extends AbstractModel
{
    use HasFactory;

    protected $fillable = ['axis', 'option'];

    protected $touches = ['proposition'];

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
