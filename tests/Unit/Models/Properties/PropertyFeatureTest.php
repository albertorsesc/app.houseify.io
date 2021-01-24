<?php

namespace Tests\Unit\Models\Properties;

use Tests\PropertyTestCase;
use App\Models\Properties\{Property, PropertyFeature};

class PropertyFeatureTest extends PropertyTestCase
{
    /**
     *   @test
     *   @throws \Throwable
     */
    public function property_feature_belongs_to_property()
    {
        $this->signIn();

        $this->assertInstanceOf(
            Property::class,
            $this->create(PropertyFeature::class)->property
        );
    }
}
