<?php

namespace FTW\Policies;

use FTW\User;
use FTW\Repositories\Blogs\Blog;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the blog.
     *
     * @param  \FTW\User  $user
     * @param  \FTW\Repositories\Categories\Blog  $blog
     * @return mixed
     */
    public function view(User $user, Blog $blog = null)
    {
        return $user->hasAccess(['blog.view']);
    }

    /**
     * Determine whether the user can create blog.
     *
     * @param  \FTW\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['blog.create']);
    }

    /**
     * Determine whether the user can update the blog.
     *
     * @param  \FTW\User  $user
     * @param  \FTW\Repositories\Categories\Blog  $blog
     * @return mixed
     */
    public function update(User $user, Blog $blog)
    {
        return $user->hasAccess(['blog.update']);
    }

    /**
     * Determine whether the user can delete the blog.
     *
     * @param  \FTW\User  $user
     * @param  \FTW\Repositories\Categories\Blog  $blog
     * @return mixed
     */
    public function delete(User $user, Blog $blog)
    {
        return $user->hasAccess(['blog.delete']);
    }
}
