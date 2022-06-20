<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Laravel 8 uses Tailwind.css by default for pagination. Add this for keep on using bootstrap
        Paginator::useBootstrap();
        // Blade::if ('can', function ($resource, ...$params) {
        //     return app(\App\Components\Contracts\Gate::class)->check($resource, $params);
        // });
    }
}
