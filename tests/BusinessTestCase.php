<?php

namespace Tests;

use App\Models\Location;
use App\Models\Businesses\Business;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BusinessTestCase extends TestCase
{
    use RefreshDatabase;

    protected function setUp () : void
    {
        parent::setUp();
    }

    public function makeBusiness($overrides = []) : array
    {
        return array_merge([
            'name' => 'Mi Negocio',
            'categories' => collect(config('houseify.construction_categories'))->random(3)->toArray(),
            'email' => 'info@minegocio.com',
            'phone' => '6862894998',
            'site' => 'https://mi-negocio.com',
            'comments' => 'Comentarios Adicionales',
        ], $overrides);
    }

    public function makeBusinessLocation(Business $property)
    {
        return $this->make(Location::class, [
            'locationable_id' => $property->id,
            'locationable_type' => get_class($property)
        ]);
    }

    public function createBusinessLocation(Business $property)
    {
        return $this->create(Location::class, [
            'locationable_id' => $property->id,
            'locationable_type' => get_class($property)
        ]);
    }
}
