<?php

namespace Tests\Feature\Api\Sepomex;

use Tests\TestCase;
use App\Services\GeoLocations\Mexico\SepomexApi;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NeighborhoodsByCityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws \Throwable
     */
    public function get_neighborhoods_by_city()
    {
        $this->markTestSkipped();
        $this->signIn();

        $cities = (new SepomexApi())->getCitiesByState('Baja California');
        $mexicali = $cities[0];

        $response = $this->getJson(route('api.cities.neighborhoods.index', $mexicali));
        $response->assertOk();
    }
}
