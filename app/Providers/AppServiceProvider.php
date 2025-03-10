<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // admin
        Gate::define('admin', function(User $user) {
            return $user->role_id == 3;
        });

        // resepsonis
        Gate::define('resepsonis', function(User $user) {
            return $user->role_id == 2;
        });

        // pengunjung
        Gate::define('pengunjung', function(User $user) {
            return $user->role_id == 1;
        });
    }
}
