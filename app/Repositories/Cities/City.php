<?php

namespace FTW\Repositories\Cities;

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


    /**
     * Relationship with district
     * @return [type] [description]
     */
    public function districts()
    {
        return $this->hasMany(\FTW\Repositories\Districts\District::class);
    }

    /**
     * Relationship with user
     * @return [type] [description]
     */
    public function users()
    {
        return $this->hasMany(\FTW\User::class);
    }
}
