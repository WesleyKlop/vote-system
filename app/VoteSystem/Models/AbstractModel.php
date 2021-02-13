<?php

namespace App\VoteSystem\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class AbstractModel.
 * @mixin Eloquent
 * @property string $id
 */
abstract class AbstractModel extends Model
{
    public $timestamps = false;
    protected $keyType = 'uuid';
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
