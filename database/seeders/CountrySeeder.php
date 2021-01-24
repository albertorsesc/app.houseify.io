<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [
                'id' => 1,
                'name' => 'United States',
                'code' => 'US',
                'is_supported' => false,
            ],
            [
                'id' => 2,
                'name' => 'Mexico',
                'code' => 'MX',
                'is_supported' => true,
            ],
        ];

        \DB::table('countries')->insert($countries);
    }
}
