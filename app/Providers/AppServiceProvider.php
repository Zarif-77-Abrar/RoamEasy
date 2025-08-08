<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\Destination;
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
        // Share cities and categories with all views in the "destinations.*" namespace
        View::composer('destinations.*', function ($view) {
            $view->with('cities', Destination::distinct()->pluck('location'))
                 ->with('categories', Destination::distinct()->pluck('category'));
        });
    }
}
