<?php

namespace Feature\Api\Properties\Concerns;

use Tests\TestCase;
use App\Models\Properties\Concerns\BusinessType;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BusinessTypesTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.business-types.';

    /**
     *   @test
     *   @throws \Throwable
     *   @endpoint ['GET' => '/api/business-types']
     */
    public function authenticated_user_can_get_all_business_types()
    {
        $this->signIn();

        $response = $this->getJson(route($this->routePrefix . 'index'));
        $response->assertOk();
        $response->assertJson(['data' => BusinessType::all()]);
    }
}
