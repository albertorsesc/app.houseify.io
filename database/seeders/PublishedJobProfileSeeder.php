<?php

namespace Database\Seeders;

use App\Models\JobProfiles\JobProfile;
use App\Models\Location;
use Illuminate\Database\Seeder;

class PublishedJobProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Auth::loginUsingId(1);

        $jobProfile = JobProfile::factory()->create([
            'title' => 'Electricista con +15 anios exp. en media tension',
        ]);

//        $jobProfile->location()->create(
//            Location::factory()->make()->toArray()
//        );
    }
}
