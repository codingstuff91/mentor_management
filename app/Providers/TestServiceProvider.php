<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if ($this->app->environment('testing')) {
            // Redéfinit le directive Blade @vite pour qu'elle ne fasse rien en test
            Blade::directive('vite', function () {
                return '';
            });
        }
    }
}
}
