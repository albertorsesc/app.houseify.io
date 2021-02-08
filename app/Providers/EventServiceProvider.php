<?php

namespace App\Providers;

use App\Events\Logs\LogActions;
use App\Events\SuggestionSubmitted;
use App\Listeners\NewSuggestion;
use App\Listeners\PersistLogActions;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        Verified::class => [],
        /*SuggestionSubmitted::class => [
            NewSuggestion::class,
        ],*/
        LogActions::class => [PersistLogActions::class],
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
