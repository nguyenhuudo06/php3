<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Category gate
        Gate::define('view_category', function (User $user) {
            return $user->checkPermissionAccess('view_category');
        });

        Gate::define('add_category', function (User $user) {
            return $user->checkPermissionAccess('add_category');
        });
        Gate::define('update_category', function (User $user) {
            return $user->checkPermissionAccess('update_category');
        });
        Gate::define('delete_category', function (User $user) {
            return $user->checkPermissionAccess('delete_category');
        });

        // roduct gate
        Gate::define('view_product', function (User $user) {
            return $user->checkPermissionAccess('view_product');
        });

        Gate::define('add_product', function (User $user) {
            return $user->checkPermissionAccess('add_product');
        });
        Gate::define('update_product', function (User $user) {
            return $user->checkPermissionAccess('update_product');
        });
        Gate::define('delete_product', function (User $user) {
            return $user->checkPermissionAccess('delete_product');
        });
    }
}
