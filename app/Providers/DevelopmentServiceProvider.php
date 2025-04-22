<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class DevelopmentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasAnyRole(['superadmin', 'developer', 'tester']) ? true : null;
        });

        // $this->registerPolicies();

        Gate::define('viewLogViewer', function (?User $user) {
            return $user->hasAnyRole(['superadmin', 'developer', 'tester']) ? true : null;
        });
    }
}
