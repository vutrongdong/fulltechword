<?php

namespace App\Policies;

use App\User;
use App\Repositories\Categories\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the category.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\Category  $category
     * @return mixed
     */
    public function view(User $user, Category $category = null)
    {
        return $user->hasAccess(['category.view']);
    }

    /**
     * Determine whether the user can create category.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['category.create']);
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\Category  $category
     * @return mixed
     */
    public function update(User $user, Category $category)
    {
        return $user->hasAccess(['category.update']);
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\Category  $category
     * @return mixed
     */
    public function delete(User $user, Category $category)
    {
        return $user->hasAccess(['category.delete']);
    }
}
