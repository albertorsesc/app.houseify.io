<?php

namespace App\Observers\Businesses;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Businesses\Business;
use App\Notifications\NotifyNewBusiness;
use Illuminate\Support\Facades\Notification;

class BusinessObserver
{
    /**
     * Handle the property "creating" event.
     *
     * @param Business $business
     * @return void
     */
    public function creating(Business $business)
    {
        $business->uuid = (string) Str::uuid();
        $business->slug = Str::slug($business->name);
        $business->owner_id = auth()->id();
    }

    /**
     * Handle the Business "created" event.
     *
     * @param Business $business
     *
     * @return void
     */
    public function created(Business $business)
    {
        $rootUsers = User::query()
                         ->whereIn('email', config('houseify.roles.root'))
                         ->get();
        Notification::send($rootUsers, new NotifyNewBusiness($business));
//        LogActions::dispatch('STORE', $business, auth()->user());
    }

    /**
     * Handle the property "updating" event.
     *
     * @param Business $business
     * @return void
     */
    public function updating(Business $business)
    {
    }

    /**
     * Handle the Business "updated" event.
     *
     * @param Business $business
     *
     * @return void
     */
    public function updated(Business $business)
    {
        $business->searchable();
    }

    /**
     * Handle the Business "deleted" event.
     *
     * @param Business  $business
     *
     * @return void
     */
    public function deleting(Business $business)
    {
        $business->onDelete();
    }

    /**
     * Handle the Business "deleted" event.
     *
     * @param Business  $business
     *
     * @return void
     */
    public function deleted(Business $business)
    {
    }

    /**
     * Handle the Business "restored" event.
     *
     * @param  Business  $business
     *
     * @return void
     */
    public function restored(Business $business)
    {
        //
    }

    /**
     * Handle the Business "force deleted" event.
     *
     * @param  Business  $business
     *
     * @return void
     */
    public function forceDeleted(Business $business)
    {
        //
    }
}
