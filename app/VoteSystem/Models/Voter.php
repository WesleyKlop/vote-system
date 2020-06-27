<?php

namespace App\VoteSystem\Models;

use DateTimeInterface;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\Access\Authorizable;

/**
 * Class Voter
 * @package App\VoteSystem\Models
 * @property \DateTimeInterface $used_at
 * @property string $token
 * @property Collection<int, VoterPropositionOption> $answers
 */
class Voter extends AbstractModel implements
    AuthenticatableContract,
    AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $fillable = ['token', 'used_at'];

    protected $dates = ['used_at'];

    public function answers(): HasMany
    {
        return $this->hasMany(VoterPropositionOption::class);
    }

    public function scopeUsed(Builder $query): Builder
    {
        return $query->whereNotNull('used_at');
    }
}
