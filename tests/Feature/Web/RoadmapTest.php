<?php

namespace Tests\Feature\Web;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoadmapTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws \Throwable
    */
    public function authenticated_user_can_visit_roadmap_page()
    {
        $this->signIn();

        $response = $this->get(route('web.roadmap.index'));
        $response->assertOk();
        $response->assertViewIs('updates.roadmap');
    }
}
