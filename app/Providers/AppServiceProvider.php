<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrapFive();

        Gate::define('admin', function (User $user) {
            return $user->level === 'admin';
        });

        Gate::define('direktur', function (User $user) {
            return $user->level === 'direktur';
        });

        Gate::define('kepala', function (User $user) {
            return $user->level === 'kepala';
        });

        Gate::define('penjab', function (User $user) {
            return $user->level === 'penjab';
        });
    }
}
