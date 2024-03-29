<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private array $seeders = [
        UserSeeder::class,
        PropertyTypeSeeder::class,
        PropertyCategorySeeder::class,
        AddGardenPropertyTypeAndCategoriesSeeder::class,
        CountrySeeder::class,
        StateSeeder::class,
        ThreadChannelSeeder::class,
        BusinessSeeder::class,
    ];
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call($this->seeders);
    }
}
