<?php

namespace App\Repositories\Districts;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    /**
     * Disable timestamps
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Fillable definition
     * @var array
     */
    protected $fillable = ['name', 'city_id', 'slug', 'zipcode', 'order', 'status'];
}
