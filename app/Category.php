<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 *
 * @package App
 * @property string $name
*/
class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'icon'];

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'category_company');
    }
    
    public static function categories()
    {
        return static::pluck('name', 'id');
    }
    
}
