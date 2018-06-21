<?php

namespace App\Repositories\Cities;

use Illuminate\Database\Eloquent\Model;

class City extends Model
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
    protected $fillable = ['name', 'slug', 'zipcode', 'order', 'status'];
}
