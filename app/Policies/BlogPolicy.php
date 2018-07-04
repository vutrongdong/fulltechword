<?php

namespace App\Policies;

use App\User;
use App\Repositories\Blogs\Blog;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the blog.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\Blog  $blog
     * @return mixed
     */
    public function view(User $user, Blog $blog = null)
    {
        return $user->hasAccess(['blog.view']);
    }

    /**
     * Determine whether the user can create blog.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['blog.create']);
    }

    /**
     * Determine whether the user can update the blog.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\Blog  $blog
     * @return mixed
     */
    public function update(User $user, Blog $blog)
    {
        return $user->hasAccess(['blog.update']);
    }

    /**
     * Determine whether the user can delete the blog.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\Blog  $blog
     * @return mixed
     */
    public function delete(User $user, Blog $blog)
    {
        return $user->hasAccess(['blog.delete']);
    }
}
