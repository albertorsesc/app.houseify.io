<?php

namespace Tests\Feature\Api\Properties;

use Tests\PropertyTestCase;
use Illuminate\Http\UploadedFile;
use App\Models\Properties\Property;

class PropertyImagesTest extends PropertyTestCase
{
    private string $routePrefix = 'api.properties.images.';

    protected function setUp () : void
    {
        parent::setUp();
        $this->signIn();
    }

    /**
     *   @test
     *   @throws \Throwable
     *   @endpoint ['POST', '/api/properties/{property}/images']
     */
    public function authenticated_users_can_upload_images_to_a_property()
    {
        \Storage::fake();

        $property = $this->create(Property::class);
        $requestWithImages = [
            'images' => [
                UploadedFile::fake()->image('property.jpeg', 1, 1),
                UploadedFile::fake()->image('property2.jpeg', 1, 1),
            ]
        ];

        $response = $this->postJson(route($this->routePrefix . 'store', $property), $requestWithImages);
        $response->assertStatus(201);

        $this->assertEquals(2, $property->fresh()->getOriginalMedia()->count());
        \Storage::assertExists($property->fresh()->media->pluck('file_name')->toArray());
    }
}
