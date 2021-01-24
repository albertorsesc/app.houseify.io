<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\State;
use Database\Seeders\{StateSeeder, CountrySeeder};
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws \Throwable
     */
    public function authenticated_user_can_get_all_states()
    {
        $this->loadSeeders([
            CountrySeeder::class,
            StateSeeder::class
        ]);

        $this->signIn();

        $state = State::first();

        $response = $this->getJson(route('api.states.index'));
        $response->assertOk();
        $response->assertJson([
            'data' => [
                [
                    'id' => $state->id,
                    'country' => ['id' => $state->country->id],
                    'name' => $state->name,
                    'code' => $state->code,
                ]
            ]
        ]);
    }
}
