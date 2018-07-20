<?php

namespace FTW\Repositories\LinkedSocialAccounts;

use Illuminate\Database\Eloquent\Model;

class LinkedSocialAccount extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider_name', 'provider_id', 'user_id'
    ];

    /**
     * Relationship with User
     * @return Model
     */
    public function user()
	{
	    return $this->belongsTo('FTW\User');
	}
}
