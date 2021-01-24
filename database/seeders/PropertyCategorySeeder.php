<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PropertyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $propertyCategories = [

            /** Residencial */
            [
                'id' => 1,
                'property_type_id' => 1,
                'name' => 'house',
                'display_name' => 'Casa'
            ],
            [
                'id' => 2,
                'property_type_id' => 1,
                'name' => 'department',
                'display_name' => 'Departamento'
            ],
            [
                'id' => 3,
                'property_type_id' => 1,
                'name' => 'condominium',
                'display_name' => 'Condominio'
            ],
            [
                'id' => 4,
                'property_type_id' => 1,
                'name' => 'ranch',
                'display_name' => 'Rancho'
            ],

            /** Comercial */
            [
                'id' => 5,
                'property_type_id' => 2,
                'name' => 'shop',
                'display_name' => 'Local'
            ],
            [
                'id' => 6,
                'property_type_id' => 2,
                'name' => 'office',
                'display_name' => 'Oficina'
            ],
            [
                'id' => 7,
                'property_type_id' => 2,
                'name' => 'building',
                'display_name' => 'Edificio'
            ],
            [
                'id' => 8,
                'property_type_id' => 2,
                'name' => 'commercial_warehouse',
                'display_name' => 'Bodega Comercial'
            ],

            /** Industrial */
            [
                'id' => 9,
                'property_type_id' => 3,
                'name' => 'industrial_warehouse',
                'display_name' => 'Bodega Industrial'
            ],
            [
                'id' => 10,
                'property_type_id' => 3,
                'name' => 'industrial_ship',
                'display_name' => 'Nave Industrial'
            ],

            // Terreno
            [
                'id' => 11,
                'property_type_id' => 4,
                'name' => 'urban_land',
                'display_name' => 'Terreno Urbano'
            ],
            [
                'id' => 12,
                'property_type_id' => 4,
                'name' => 'commercial_land',
                'display_name' => 'Terreno Comercial'
            ],
            [
                'id' => 13,
                'property_type_id' => 4,
                'name' => 'industrial_land',
                'display_name' => 'Terreno Industrial'
            ],
            [
                'id' => 14,
                'property_type_id' => 4,
                'name' => 'agriculture_land',
                'display_name' => 'Terreno Agricola'
            ],
        ];

        \App\Models\Properties\PropertyCategory::insert($propertyCategories);
    }
}
