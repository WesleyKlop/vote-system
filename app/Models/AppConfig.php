<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class AppConfig extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'name';
    public $timestamps = false;

    protected $fillable = ['name', 'default', 'value'];

    public static function getValue(string $name)
    {
        $entry = self::findOrFail($name);

        return $entry->value ?? $entry->default;
    }

    public static function dictionary(): Collection
    {
        return self::all()->mapWithKeys(
            fn($row) => [$row->name => $row->value ?: $row->default]
        );
    }
}
