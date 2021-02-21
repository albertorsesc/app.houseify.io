<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\{Businesses\Business, JobProfiles\JobProfile, Properties\Property};
use App\Observers\{Businesses\BusinessObserver, JobProfileObserver, Properties\PropertyObserver};

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
        JobProfile::observe(JobProfileObserver::class);
    }
}
