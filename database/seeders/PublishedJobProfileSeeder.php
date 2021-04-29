<?php

namespace Database\Seeders;

use App\Models\JobProfiles\JobProfile;
use App\Models\Location;
use App\Models\User;
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
        foreach (User::all() as $user) {
            \Auth::login($user);
            $newJobProfile = JobProfile::factory()->create();

            $newJobProfile->location()->create(
                Location::factory()->make()->toArray()
            );

            $newJobProfile->update(['status' => true]);
            \Auth::logout();
        }

        \Auth::loginUsingId(1);

        $jobProfiles = [
            [
                'title' => 'Electricista con mas de 10 anios de experiencia',
                'skills' => ['Electricista', 'Herrero', 'Plomero'],
                'email' => 'electricista@gmail.com',
                'phone' => '(686)289.4998',
                'facebook_profile' => 'https://www.facebook.com/electricista',
                'linkedin_profile' => 'https://www.linkedin.com/electricista',
                'site' => 'https://electricista.com',
                'bio' => 'Se hacen trabajos a domicilio'
            ],
        ];

        foreach ($jobProfiles as $jobProfile) {
            $newJobProfile = JobProfile::create($jobProfile);

            $newJobProfile->location()->create(
                Location::factory()->make()->toArray()
            );

            $newJobProfile->update(['status' => true]);
        }
    }
}
