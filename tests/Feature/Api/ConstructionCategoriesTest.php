<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConstructionCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws \Throwable
     */
    public function get_all_construction_categories()
    {
        $this->signIn();

        $category = config('houseify.construction_categories')[0];

        $response = $this->getJson(route('api.construction-categories.index'));
        $response->assertOk();
        $response->assertJson(['data' => [$category]]);
    }
}
