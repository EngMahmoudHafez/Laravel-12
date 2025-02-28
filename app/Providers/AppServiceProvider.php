<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Foundation\Http\Middleware\TrimStrings;
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
        TrimStrings::except(['secret']);
        RedirectIfAuthenticated::redirectUsing(function () {
            return 'custom-redirect';
        });

        RedirectIfAuthenticated::redirectUsing(fn() => 'custom-redirect');
    }
}
