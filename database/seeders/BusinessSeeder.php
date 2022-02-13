<?php

namespace Database\Seeders;

use App\Models\Businesses\Business;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Event;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::fake();
        Business::factory()->create(['owner_id' => 1]);
    }
}
