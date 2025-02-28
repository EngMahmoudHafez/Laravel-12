<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Http\Middleware\TrimStrings;
use Illuminate\Support\Facades\RateLimiter;
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
        RateLimiter::for('api',function ($request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });

        TrimStrings::except(['secret']);
        RedirectIfAuthenticated::redirectUsing(function () {
            return 'custom-redirect';
        });

        RedirectIfAuthenticated::redirectUsing(fn() => 'custom-redirect');
    }
}
