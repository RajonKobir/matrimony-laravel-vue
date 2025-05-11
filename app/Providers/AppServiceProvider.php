<?php

namespace App\Providers;

use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Support\Facades\Vite;
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
        // Disable CSRF validation for specific routes
        ValidateCsrfToken::except(['mails/proposals']);
        Vite::prefetch(concurrency: 3);
    }
}
