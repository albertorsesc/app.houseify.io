<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\{Businesses\Business, Properties\Property};
use App\Observers\{Businesses\BusinessObserver, Properties\PropertyObserver};

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
        Business::observe(BusinessObserver::class);
    }
}
