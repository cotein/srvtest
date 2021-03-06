<?php

namespace App\Src\Models;

use Nestable\NestableTrait;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use Sluggable;

    protected $guarded =[];

    protected $fillable = [];

    protected $parent = 'parent_id';

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            /* 'slug' => [
                'source' => 'name'
            ] */
        ];
    }
    
    public function products()
    {
        return $this->hasMany(Product::class, 'code', 'code');
    }
}
