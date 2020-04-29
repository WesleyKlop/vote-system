<?php


namespace App;


use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractModel
 * @package App
 * @mixin Eloquent
 */
abstract class AbstractModel extends Model
{
    public $timestamps = false;
    protected $keyType = 'uuid';
}
