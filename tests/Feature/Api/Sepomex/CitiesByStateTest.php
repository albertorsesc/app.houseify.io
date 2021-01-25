<?php

namespace Tests\Feature\Api\Sepomex;

use Tests\TestCase;
use App\Models\State;
use Database\Seeders\{CountrySeeder, StateSeeder};
use Illuminate\Foundation\Testing\RefreshDatabase;

class CitiesByStateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws \Throwable
     */
    public function get_cities_by_state()
    {
        $this->loadSeeders([
            CountrySeeder::class,
            StateSeeder::class
        ]);

        $this->signIn();

        $state = State::query()->inRandomOrder()->first();

        $response = $this->getJson(route('api.states.cities.index', $state->name));
        $response->assertOk();
    }
}
