<?php

namespace App\Providers;

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
        Gate::define('admin', function ($user) {
            return $user->isAdmin();
        });

        // Optimize query performance by setting default pagination
        \Illuminate\Pagination\Paginator::useBootstrap();

        // Force HTTPS and set trusted proxy for production (Railway)
        if (config('app.env') !== 'local') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
            \Illuminate\Support\Facades\URL::forceRootUrl(config('app.url'));
        }

        // Share common data to all views (optional optimization)
        // view()->composer('*', function ($view) {
        //     // Add common data if needed
        // });
    }
}
