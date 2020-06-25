<?php

namespace App\VoteSystem\Models;

use Illuminate\Database\Eloquent\Model;

class AppConfig extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'name';

    protected $fillable = [
        'name',
        'default',
        'value'
    ];

    public static function getValue(string $name) {
        $entry = self::findOrFail($name);
        return $entry->value ?? $entry->default;
    }
}
