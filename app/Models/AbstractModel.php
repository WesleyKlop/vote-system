<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

abstract class AbstractModel extends Model
{
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * Boot the model.
     */
    public static function boot()
    {
        parent::boot();

        // Use the model creating event
        static::creating(function (self $entity) {
            if ($entity->getKey()) {
                return;
            }

            $entity->{$entity->getKeyName()} = Str::uuid()->toString();
        });
    }
}
