<?php

namespace Database\Seeders;

use App\Models\Businesses\Business;
use App\Models\Location;
use App\Models\Properties\Concerns\BusinessType;
use App\Models\Properties\Property;
use App\Models\Properties\PropertyCategory;
use App\Models\Properties\PropertyFeature;
use App\Models\User;
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

        $properties = [
            [
                'title' => 'Casa hermosa junto a la playa en Rosarito',
                'price' => 1000,
                'property_category_id' => PropertyCategory::where('name', 'house')->first()->id,
                'business_type' => BusinessType::TYPES['sale'],
                'comments' => 'Casa en la playa'
            ],
            [
                'title' => 'Oficina en zona centro',
                'price' => 15000,
                'property_category_id' => PropertyCategory::where('name', 'office')->first()->id,
                'business_type' => BusinessType::all()->random(),
            ],
            [
                'title' => 'Terreno con servicios',
                'price' => 500000,
                'property_category_id' => PropertyCategory::where('name', 'urban_land')->first()->id,
                'business_type' => BusinessType::all()->random(),
            ],
            [
                'title' => 'Departamento amueblado',
                'price' => 10000,
                'property_category_id' => PropertyCategory::where('name', 'department')->first()->id,
                'business_type' => BusinessType::all()->random(),
            ],
        ];

        foreach ($properties as $property) {
            $newProperty = Property::create($property);

            $newProperty->location()->create(
                Location::withoutEvents(fn () => Location::factory()->make()->toArray())
            );

            $newProperty->propertyFeature()->create(
                PropertyFeature::factory()->make([
                    'property_id' => null
                ])->toArray()
            );

            $newProperty->update(['status' => true]);
        }
    }
}
