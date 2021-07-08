<?php

namespace App\Models;

use App\Events\PropositionChange;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Proposition extends AbstractModel
{
    use HasFactory;

    protected $fillable = ['title', 'is_open', 'type', 'order', 'blank_option_id', 'abstain_option_id'];

    protected $casts = [
        'is_open' => 'bool',
    ];

    protected $dispatchesEvents = [
        'saved' => PropositionChange::class,
    ];

    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('is_open', true);
    }

    public function options(): HasMany
    {
        return $this
            ->hasMany(PropositionOption::class)
            ->when($this->blank_option_id,
                fn (Builder $query, string $optionId) => $query->where('id', '!=', $optionId))
            ->when($this->abstain_option_id,
                fn (Builder $query, string $optionId) => $query->where('id', '!=', $optionId));
    }

    public function blankOption(): BelongsTo
    {
        return $this->belongsTo(PropositionOption::class, 'blank_option_id');
    }

    public function abstainOption(): BelongsTo
    {
        return $this->belongsTo(PropositionOption::class, 'abstain_option_id');
    }

    public function hasBlank(): bool
    {
        return ! is_null($this->blank_option_id);
    }

    public function hasAbstain(): bool
    {
        return ! is_null($this->abstain_option_id);
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
