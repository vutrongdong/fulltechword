<?php

namespace FTW\Policies;

use FTW\User;

class RolePolicy
{
    /**
     * [create description]
     * @param  User   $user
     * @return [type]
     */
    public function create(User $user)
    {
        return $user->hasAccess(['role.create']);
    }

    /**
     * [view description]
     * @param  User   $user
     * @return [type]
     */
    public function view(User $user)
    {
        return $user->hasAccess(['role.view']);
    }

    /**
     * [update description]
     * @param  User   $user
     * @return [type]
     */
    public function update(User $user)
    {
        return $user->hasAccess(['role.update']);
    }

    /**
     * [delete description]
     * @param  User   $user
     * @return [type]
     */
    public function delete(User $user)
    {
        return $user->hasAccess(['role.delete']);
    }
}
