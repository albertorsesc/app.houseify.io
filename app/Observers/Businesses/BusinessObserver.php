<?php

namespace App\Observers\Businesses;

use Illuminate\Support\Str;
use App\Events\Logs\LogActions;
use App\Models\Businesses\Business;

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
        $business->slug = (string) Str::slug($business->name);
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
        LogActions::dispatch('UPDATE', $business, auth()->user());
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
        LogActions::dispatch('DELETE', $business, auth()->user());
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
