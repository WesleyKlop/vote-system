<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListPropositionOption extends Model
{
    protected $fillable = [
        'option',
    ];

    public function proposition(): BelongsTo
    {
        return $this->belongsTo(Proposition::class);
    }
}
