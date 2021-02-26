<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'first_name' => 'Alberto',
                'last_name' => 'Rosas',
                'email' => 'alberto.rsesc@protonmail.com',
//                'phone' => '6862894998',
                'password' => bcrypt('password'),
                'email_verified_at' => now()->toDateTimeString(),
//                'status' => true,
                'created_at' => now()->toDateTimeString(),
            ],
        ];

        \App\Models\User::insert($users);
    }
}
