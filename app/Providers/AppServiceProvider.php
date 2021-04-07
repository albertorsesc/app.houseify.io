<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\{Businesses\Business, JobProfiles\JobProfile, Properties\Property, User};
use App\Observers\{Businesses\BusinessObserver, JobProfileObserver, Properties\PropertyObserver, UserObserver};

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
        User::observe(UserObserver::class);
        Property::observe(PropertyObserver::class);
        Business::observe(BusinessObserver::class);
        JobProfile::observe(JobProfileObserver::class);
    }
}
