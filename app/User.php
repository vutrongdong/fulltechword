<?php

namespace FTW;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use FTW\Notifications\ResetPasswordNotification;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address', 'city_id', 'district_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Set the user's password.
     *
     * @param  string  $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }

    /**
     * @override
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Relationship with LinkedSocialAccount
     */
    public function accounts()
    {
        return $this->hasMany('FTW\LinkedSocialAccount');
    }

    /**
     * Relationship with Role
     */
    public function roles()
    {
        return $this->belongsToMany('FTW\Repositories\Roles\Role', 'role_users');
    }

    /**
     * Relationship with City
     */
    public function city()
    {
        return $this->belongsTo(\FTW\Repositories\Cities\City::class);
    }

    /**
     * Relationship with District
     */
    public function district()
    {
        return $this->belongsTo(\FTW\Repositories\Districts\District::class);
    }

    /**
     * [hasAccess description]
     * @param  array   $permissions
     * @return boolean
     */
    public function hasAccess(array $permissions) : bool
    {
        foreach ($this->roles as $role) {
            if ($role->hasAccess($permissions)) {
                return true;
            }
        }
        return false;
    }

    /**
     * [inRole description]
     * @param  string $slug
     * @return boolean
     */
    public function inRole(string $slug) : bool
    {
        return $this->roles()->where('slug', $slug)->count() == 1;
    }

    /**
     * [isSuperAdmin description]
     * @return boolean
     */
    public function isSuperAdmin()
    {
        return $this->hasAccess(['admin.super-admin']);
    }

    /**
     * Query by soring created_at
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSort($query, $sort)
    {
        $sorts = explode(',', $sort);
        foreach ($sorts as $sort) {
            $s = explode(':', $sort);
            if (count($s) == 2) {
                $type = $s[1] == 1 ? 'ASC' : 'DESC';
                $query = $query->orderBy($s[0], $type);
            }
        }
        return $query;
    }
}
