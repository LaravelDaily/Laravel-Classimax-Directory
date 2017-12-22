<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class City
 *
 * @package App
 * @property string $name
*/
class City extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    
    public static function cities()
    {
        return static::pluck('name', 'id');
    }
    
}
