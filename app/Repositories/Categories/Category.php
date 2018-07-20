<?php

namespace FTW\Repositories\Categories;

use FTW\Repositories\Entity;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Entity
{
    use NodeTrait;
    const ENABLE = 1;
    const DISABLE = 0;
    /**
     * Fillable definition
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'active',
        'priority',
        'parent_id'
    ];

    public function scopeQ($query, $value = null)
    {
        if ($value) {
            return $query->where('name', 'like', "%{$value}%");
        }
        return $query;
    }
}
