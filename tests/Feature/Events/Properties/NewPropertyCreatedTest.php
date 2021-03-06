<?php

namespace Tests\Feature\Events\Properties;

use App\Events\Properties\NewPropertyCreated;
use Tests\PropertyTestCase;
use App\Models\Properties\Property;

class NewPropertyCreatedTest extends PropertyTestCase
{
    /**
     * @test
     * @throws \Throwable
     */
    public function new_property_created_event_is_dispatched()
    {
        $this->fakeEvent(NewPropertyCreated::class);

        $this->signIn();

        Property::factory()->create();

        $this->assertCount(1, Property::all());

        \Event::assertDispatched(NewPropertyCreated::class);
    }
}
