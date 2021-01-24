<?php

namespace App\Providers;

use App\Models\Properties\Property;
use Illuminate\Support\ServiceProvider;
use App\Observers\Properties\PropertyObserver;

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
        Property::observe(PropertyObserver::class);
    }
}
