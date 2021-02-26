<?php

namespace Database\Seeders;

use App\Models\Businesses\Business;
use App\Models\Location;
use App\Models\Properties\Concerns\BusinessType;
use App\Models\Properties\Property;
use App\Models\Properties\PropertyCategory;
use App\Models\Properties\PropertyFeature;
use Illuminate\Database\Seeder;

class PublishedPropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Auth::loginUsingId(1);

        $property = Property::factory()->create([
            'title' => 'Casa hermosa junto a la playa en Rosarito',
        ]);

        $property->location()->create(
            Location::factory()->make()->toArray()
        );

        $property->propertyFeature()->create(
            PropertyFeature::factory()->make([
                'property_id' => null
            ])->toArray()
        );
    }
}
