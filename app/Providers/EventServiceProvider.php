<?php

namespace App\Providers;

use App\Events\Auth\NewSocialMediaUserRegistration;
use App\Events\Logs\LogActions;
use App\Events\Properties\NewPropertyCreated;
use App\Listeners\Auth\SendPasswordToNewSocialUser;
use App\Listeners\PersistLogActions;
use App\Events\Reports\NewReportSubmitted;
use App\Events\Properties\PropertyReported;
use App\Listeners\Properties\PropertyHasBeenReported;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\{Events\Verified, Events\Registered, Listeners\SendEmailVerificationNotification};

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NewSocialMediaUserRegistration::class => [
            SendPasswordToNewSocialUser::class,
        ],
        Verified::class => [],
        /*SuggestionSubmitted::class => [
            NewSuggestion::class,
        ],*/
//        LogActions::class => [PersistLogActions::class],

        /* Properties */

        NewReportSubmitted::class => [
            PropertyHasBeenReported::class,
        ],

        /*NewPropertyCreated::class => [

        ],*/

        /* Reports */

        /*NewReportSubmitted::class => [
            PropertyHasBeenReported::class,
        ],*/
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
