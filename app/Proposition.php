<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use RuntimeException;

class Proposition extends AbstractModel
{
    protected $fillable = [
        'title',
        'is_open',
        'type',
    ];

    public function scopeOpen(Builder $query)
    {
        return $query->where('is_open', true);
    }

    public function options()
    {
        switch ($this->type) {
            case 'list':
                return $this->listOptions();
            case 'grid':
                return $this->gridOptions();
            default:
                throw new RuntimeException('Invalid proposition type '.$this->type);
        }
    }

    public function listOptions(): HasMany
    {
        return $this->hasMany(ListPropositionOption::class);
    }

    public function gridOptions(): HasMany
    {
        return $this->hasMany(GridPropositionOption::class);
    }
}
