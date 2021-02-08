<?php

namespace Tests\Unit\Models\Businesses;

use Tests\TestCase;
use App\Models\User;
use App\Models\Businesses\Business;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BusinessTest extends TestCase
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
}
