<?php

namespace App\Observers\Properties;

use App\Events\Properties\NewPropertyCreated;
use Illuminate\Support\Str;
use App\Events\Logs\LogActions;
use App\Models\Properties\Property;

class PropertyObserver
{
    /**
     * Handle the property "creating" event.
     *
     * @param Property $property
     * @return void
     */
    public function creating(Property $property)
    {
        $property->uuid = (string) Str::uuid();
        $property->slug = (string) Str::slug($property->title) . '-' . $property->uuid;
        $property->seller_id = auth()->id();

        NewPropertyCreated::dispatch();
    }

    /**
     * Handle the Property "created" event.
     *
     * @param Property $property
     *
     * @return void
     */
    public function created(Property $property)
    {
        LogActions::dispatch('STORE', $property, auth()->user());
    }

    /**
     * Handle the property "updating" event.
     *
     * @param Property $property
     * @return void
     */
    public function updating(Property $property)
    {
        $property->slug = (string) Str::slug($property->title) . '-' . $property->uuid;
    }

    /**
     * Handle the Property "updated" event.
     *
     * @param Property $property
     *
     * @return void
     */
    public function updated(Property $property)
    {
        LogActions::dispatch('UPDATE', $property, auth()->user());
    }

    /**
     * Handle the Property "deleting" event.
     *
     * @param Property  $property
     *
     * @return void
     */
    public function deleting(Property $property)
    {
        $property->onDelete();
    }

    /**
     * Handle the Property "deleted" event.
     *
     * @param Property  $property
     *
     * @return void
     */
    public function deleted(Property $property)
    {
        LogActions::dispatch('DELETE', $property, auth()->user());
    }

    /**
     * Handle the Property "restored" event.
     *
     * @param  Property  $property
     *
     * @return void
     */
    public function restored(Property $property)
    {
        //
    }

    /**
     * Handle the Property "force deleted" event.
     *
     * @param  Property  $property
     *
     * @return void
     */
    public function forceDeleted(Property $property)
    {
        //
    }
}
