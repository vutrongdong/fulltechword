<?php

namespace App\Policies;

use App\User;
use App\Repositories\Tags\Tag;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the tag.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\Tag  $tag
     * @return mixed
     */
    public function view(User $user, Tag $tag = null)
    {
        return $user->hasAccess(['tag.view']);
    }

    /**
     * Determine whether the user can create tag.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['tag.create']);
    }

    /**
     * Determine whether the user can update the tag.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\Tag  $tag
     * @return mixed
     */
    public function update(User $user, Tag $tag)
    {
        return $user->hasAccess(['tag.update']);
    }

    /**
     * Determine whether the user can delete the tag.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\Tag  $tag
     * @return mixed
     */
    public function delete(User $user, Tag $tag)
    {
        return $user->hasAccess(['tag.delete']);
    }
}
