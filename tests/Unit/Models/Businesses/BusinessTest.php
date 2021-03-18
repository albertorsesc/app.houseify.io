<?php

namespace Tests\Unit\Models\Businesses;

use Tests\BusinessTestCase;
use Database\Seeders\StateSeeder;
use Database\Seeders\CountrySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\{User, Location, Businesses\Business};

class BusinessTest extends BusinessTestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws \Throwable
     */
    public function business_belongs_to_an_owner()
    {
        $this->signIn();

        $this->assertInstanceOf(
            User::class,
            $this->create(Business::class)->owner
        );
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function business_has_one_location()
    {
        $this->loadSeeders([
            CountrySeeder::class,
            StateSeeder::class,
        ]);
        $this->signIn();
        $business = $this->create(Business::class);
        $this->createBusinessLocation($business);

        $this->assertInstanceOf(Location::class, $business->fresh()->location);
    }
}
