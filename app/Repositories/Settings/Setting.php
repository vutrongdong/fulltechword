<?php

namespace FTW\Repositories\Settings;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'keywords',
        'description',
        'name',
        'address',
        'phone',
        'email',
        'tax_number',
        'bank',
        'about',
        'facebook',
        'instagram',
        'zalo',
    ];
}
