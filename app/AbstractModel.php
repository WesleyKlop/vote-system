<?php


namespace App;


use App\WhiteBox\Contracts\EntityModel;
use App\WhiteBox\Support\Helpers\EntityHelper;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class AbstractModel
 * @package App
 * @mixin Eloquent
 */
abstract class AbstractModel extends Model
{
    public $timestamps = false;
    protected $keyType = 'uuid';
    public $incrementing = false;

    /**
     * Boot the model
     */
    public static function boot()
    {
        parent::boot();

        // Use the model creating event
        static::creating(function (AbstractModel $entity) {
            if ($entity->getKey()) {
                return;
            }

            $entity->{$entity->getKeyName()} = Str::uuid();
        });
    }
}
