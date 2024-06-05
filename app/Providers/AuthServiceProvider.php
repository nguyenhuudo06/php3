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

        Gate::define('product-view', function (User $user) {
            return $user->checkPermissionAccess('view_product');
        });

        Gate::define('product-delete', function (User $user) {
            return $user->checkPermissionAccess('delete_product');
        });

        Gate::define('category-view', function (User $user) {
            return $user->checkPermissionAccess('view_category');
        });

        Gate::define('brand-delete', function (User $user) {
            return $user->checkPermissionAccess('brand-delete');
        });
    }
}
