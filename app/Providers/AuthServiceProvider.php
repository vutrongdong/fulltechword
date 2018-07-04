<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Repositories\Roles\Role::class          => \App\Policies\RolePolicy::class,
        \App\Repositories\Categories\Category::class => \App\Policies\CategoryPolicy::class,
        \App\Repositories\Blogs\Blog::class          => \App\Policies\BlogPolicy::class,
        \App\Repositories\Tags\Tag::class            => \App\Policies\TagPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->registerGates();

        $this->registerGates();
    }

    /**
     * Register passport
     * @return void
     */
    private function registerPassport()
    {
        Passport::routes();
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
    }

    /**
     * Register gates
     * @return void
     */
    private function registerGates()
    {
        Gate::before(function ($user, $ability) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });

        Gate::define('access-admin', function ($user) {
            return $user->hasAccess(['admin.access']);
        });

        Gate::define('manage-user', function ($user) {
            return $user->hasAccess(['admin.manage-user']);
        });

        Gate::define('config-site', function ($user) {
            return $user->hasAccess(['setting.update']);
        });

        Gate::define('view-report', function ($user) {
            return $user->hasAccess(['admin.report']);
        });

        /**
         * This is identical to manually defining the following Gate definitions:
         * Gate::define('roles.view', 'App\Policies\RolePolicy@view');
         * Gate::define('roles.create', 'App\Policies\RolePolicy@create');
         * Gate::define('roles.update', 'App\Policies\RolePolicy@update');
         * Gate::define('roles.delete', 'App\Policies\RolePolicy@delete');
         */
        Gate::resource('roles', \App\Policies\RolePolicy::class);
        Gate::resource('category', \App\Policies\CategoryPolicy::class);
        Gate::resource('blog', \App\Policies\BlogPolicy::class);
        Gate::resource('tag', \App\Policies\TagPolicy::class);
    }
}
