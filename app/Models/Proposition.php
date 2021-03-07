<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * Class Proposition.
 * @property string $title
 * @property bool $is_open
 * @property string $type
 * @property int $order
 * @property Collection<PropositionOption> $options
 * @property Collection<Voter> $voters
 * @property Collection<VoterPropositionOption> $answers
 */
class Proposition extends AbstractModel
{
    use HasFactory;

    protected $fillable = ['title', 'is_open', 'type', 'order'];

    protected $casts = [
        'is_open' => 'bool',
    ];

    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('is_open', true);
    }

    public function options(): HasMany
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

    public function voters(): HasManyThrough
    {
        return $this->hasManyThrough(
            Voter::class,
            VoterPropositionOption::class,
            'proposition_id',
            'id',
            'id',
            'voter_id'
        );
    }

    public function answers(): HasMany
    {
        return $this->hasMany(VoterPropositionOption::class);
    }
}
