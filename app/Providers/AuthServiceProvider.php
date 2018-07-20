<?php

namespace FTW\Providers;

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
        \FTW\Repositories\Roles\Role::class          => \FTW\Policies\RolePolicy::class,
        \FTW\Repositories\Categories\Category::class => \FTW\Policies\CategoryPolicy::class,
        \FTW\Repositories\Blogs\Blog::class          => \FTW\Policies\BlogPolicy::class,
        \FTW\Repositories\Tags\Tag::class            => \FTW\Policies\TagPolicy::class,
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
         * Gate::define('roles.view', 'FTW\Policies\RolePolicy@view');
         * Gate::define('roles.create', 'FTW\Policies\RolePolicy@create');
         * Gate::define('roles.update', 'FTW\Policies\RolePolicy@update');
         * Gate::define('roles.delete', 'FTW\Policies\RolePolicy@delete');
         */
        Gate::resource('roles', \FTW\Policies\RolePolicy::class);
        Gate::resource('category', \FTW\Policies\CategoryPolicy::class);
        Gate::resource('blog', \FTW\Policies\BlogPolicy::class);
        Gate::resource('tag', \FTW\Policies\TagPolicy::class);
    }
}
