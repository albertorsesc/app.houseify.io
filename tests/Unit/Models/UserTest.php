<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\{Businesses\Business, User, Properties\Property};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\{PropertyTypeSeeder, PropertyCategorySeeder};

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     *   @test
     *   @throws \Throwable
     */
    public function user_belongs_to_many_properties()
    {
        $this->signIn();

        $this->loadSeeders([
            PropertyTypeSeeder::class,
            PropertyCategorySeeder::class,
        ]);

        $this->create(Property::class);

        $this->assertInstanceOf(Property::class, auth()->user()->properties->first());
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function user_belongs_to_many_businesses()
    {
        $this->signIn();

        $this->create(Business::class);

        $this->assertInstanceOf(Business::class, auth()->user()->businesses->first());
    }
}
