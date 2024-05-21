<?php

namespace App\Providers;

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
    public function boot()
    {
        // Using a view composer to pass the logged user to all views
        // With this the $user variable will be available in all views across the app without needing to explicitly pass it from a controller.
        view()->composer('*', function ($view) {
            $view->with('user', Auth::user());
        });
    }
}
