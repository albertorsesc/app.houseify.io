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

        $jobProfiles = [
            [
                'title' => 'Electricista con mas de 10 anios de experiencia',
                'skills' => ['Electricista', 'Herrero', 'Plomero'],
                'birthdate_at' => now()->subDecades(rand(1, 5))->toDateTime(),
                'email' => 'electricista@gmail.com',
                'phone' => '(686)289.4998',
                'facebook_profile' => 'https://www.facebook.com/electricista',
                'site' => 'https://electricista.com',
                'bio' => 'Se hacen trabajos a domicilio'
            ],
            [
                'title' => 'Pintor con mas de 10 anios de experiencia en acabados',
                'skills' => ['Pintor'],
                'birthdate_at' => now()->subDecades(rand(1, 5))->toDateTime(),
                'email' => 'pintor@gmail.com',
                'phone' => '(686)289.4998',
                'facebook_profile' => 'https://www.facebook.com/pintor',
                'site' => 'https://pintor.com',
                'bio' => 'Se hacen trabajos a domicilio'
            ],
            [
                'title' => 'Albanil con mas de 10 anios de experiencia en acabados',
                'skills' => ['Albanil'],
                'birthdate_at' => now()->subDecades(rand(1, 5))->toDateTime(),
                'email' => 'pintor@gmail.com',
                'phone' => '(686)289.4998',
                'facebook_profile' => 'https://www.facebook.com/pintor',
                'site' => 'https://pintor.com',
                'bio' => 'Se hacen trabajos a domicilio'
            ],
        ];

        foreach ($jobProfiles as $jobProfile) {
            $newJobProfile = JobProfile::create($jobProfile);

            $newJobProfile->location()->create(
                Location::factory()->make()->toArray()
            );
        }
    }
}
