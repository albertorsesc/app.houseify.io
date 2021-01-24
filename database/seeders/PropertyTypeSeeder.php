<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $propertyTypes = [
            [
                'id' => 1,
                'name' => 'residential',
                'display_name' => 'Residencial'
            ],
            [
                'id' => 2,
                'name' => 'commercial',
                'display_name' => 'Comercial',
            ],
            [
                'id' => 3,
                'name' => 'industrial',
                'display_name' => 'Industrial',
            ],
            [
                'id' => 4,
                'name' => 'land',
                'display_name' => 'Terreno',
            ],
        ];

        \DB::table('property_types')->insert($propertyTypes);
    }
}
