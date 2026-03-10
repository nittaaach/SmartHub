<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
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

        view()->composer('*', function ($view) {
            $user = Auth::user();

            if (!$user) {
                // If route has no specific auth middleware, find if they are logged in anywhere
                foreach (['rw', 'pkk', 'katar', 'rt', 'web'] as $guard) {
                    if (Auth::guard($guard)->check()) {
                        $user = Auth::guard($guard)->user();
                        break;
                    }
                }
            }

            $view->with('user', $user);
        });
    }
}
