<?php

namespace App\Observers\Properties;

use Illuminate\Support\Str;
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
//        $property->slug = (string) Str::slug($property->title) . '-' . $property->uuid;
        $property->seller_id = auth()->id();
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
        //
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
        //
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
        //
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
