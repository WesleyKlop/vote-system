<?php

namespace App\VoteSystem\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\Authorizable;

class Voter extends AbstractModel implements
    AuthenticatableContract,
    AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $fillable = ['token', 'used_at'];

    protected $dates = ['used_at'];

    public function answers()
    {
        return $this->hasMany(VoterPropositionOption::class);
    }

    public function scopeUsed(Builder $query)
    {
        return $query->whereNotNull('used_at');
    }
}
