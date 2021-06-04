<?php

namespace Database\Seeders;

use App\Models\Properties\PropertyCategory;
use App\Models\Properties\PropertyType;
use Illuminate\Database\Seeder;

class AddGardenPropertyTypeAndCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newPropertyType = [
            [
                'id' => 5,
                'name' => 'garden',
                'display_name' => 'Jardín',
            ],
        ];
        PropertyType::insert($newPropertyType);

        $newPropertyCategories = [
            /* Jardines */
            [
                'id' => 15,
                'property_type_id' => 5,
                'name' => 'event_garden',
                'display_name' => 'Jardín de Eventos'
            ],
            [
                'id' => 16,
                'property_type_id' => 5,
                'name' => 'wedding_garden',
                'display_name' => 'Jardín de Bodas'
            ],
            [
                'id' => 17,
                'property_type_id' => 5,
                'name' => 'party_garden',
                'display_name' => 'Jardín de Fiestas'
            ],
        ];

        PropertyCategory::insert($newPropertyCategories);
    }
}
