<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-users', function ($user) {
            return $user->hasAnyRole(['super-admin', 'admin']);
        });

        Gate::define('delete-users', function ($user) {
            return $user->isSuperAdmin();
        });

        Gate::define('edit-users', function ($user) {
            return $user->hasAnyRole(['super-admin', 'admin']);
        });


    }
}
