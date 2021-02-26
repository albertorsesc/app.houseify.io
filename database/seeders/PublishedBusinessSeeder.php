<?php

namespace Database\Seeders;

use App\Models\Businesses\Business;
use App\Models\Location;
use Illuminate\Database\Seeder;

class PublishedBusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Auth::loginUsingId(1);

        $business = Business::factory()->create([
            'name' => 'Electrica Rosas',
        ]);

        $business->location()->create(
            Location::factory()->make()->toArray()
        );
    }
}
