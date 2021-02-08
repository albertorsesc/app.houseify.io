<?php

namespace Tests\Feature\Api\Businesses;

use Tests\TestCase;
use App\Models\Businesses\Business;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthUserBusinessesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws \Throwable
     * @only ['authenticated', 'seller']
     */
    public function authorized_user_can_get_own_businesses()
    {
        $this->signIn();

        $this->create(Business::class);

        $response = $this->getJson(route('api.me.businesses'));
        $response->assertOk();
        $response->assertJson([
            'data' => [
                [
                    'name' => auth()->user()->businesses->first()->name,
                ]
            ]
        ]);
    }
}
