<?php

namespace FTW\Repositories\Tags;

use FTW\Repositories\Entity;

class Tag extends Entity
{
    /**
     * Fillable definition
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'color',
    ];

    public function scopeQ($query, $value = null)
    {
        if ($value) {
            return $query->where('name', 'like', "%{$value}%");
        }
        return $query;
    }
}
