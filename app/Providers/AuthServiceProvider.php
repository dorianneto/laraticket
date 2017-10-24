<?php

namespace App\Providers;

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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('metric-ticket', function ($user) {
            return $user->hasAccess(['metric-ticket']);
        });

        Gate::define('list-ticket', function ($user) {
            return $user->hasAccess(['list-ticket']);
        });

        Gate::define('show-ticket', function ($user) {
            return $user->hasAccess(['show-ticket']);
        });

        Gate::define('delete-ticket', function ($user) {
            return $user->hasAccess(['delete-ticket']);
        });

        Gate::define('create-ticket', function ($user) {
            return $user->hasAccess(['create-ticket']);
        });

        Gate::define('edit-profile', function ($user) {
            return $user->hasAccess(['edit-profile']);
        });

        Gate::define('action-ticket', function ($user) {
            return !$user->inRole('customer');
        });

        Gate::define('see-auxiliares', function ($user) {
            return $user->inRole('manager');
        });
    }
}
