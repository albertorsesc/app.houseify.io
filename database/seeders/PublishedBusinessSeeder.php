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

        $businesses = [
            [
                'name' => 'Electrica Rosas',
                'categories' => ['Electricidad', 'Ferreteria', 'Plomeria'],
                'email' => 'cotizaciones@electricarosas.com',
                'phone' => '(686)289.4998',
                'site' => 'https://electrica-rosas.com',
                'facebook_profile' => 'https://www.facebook.com/electrica-rosas',
                'comments' => 'Martes con 10% de descuento en cable numero 12'
            ],
            [
                'name' => 'Pinturas Locas',
                'categories' => ['Pintura'],
                'email' => 'cotizaciones@pinturaslocas.com',
                'phone' => '(686)289.4998',
                'site' => 'https://pinturas-locas.com',
                'facebook_profile' => 'https://www.facebook.com/pinturas-locas',
                'comments' => 'Brochas gratis en la compra de 10 litros de pintura'
            ],
            [
                'name' => 'Polaris',
                'categories' => ['A/C'],
                'email' => 'cotizaciones@polaris.com',
                'phone' => '(686)289.4998',
                'site' => 'https://polaris-aire-acondicionado.com',
                'facebook_profile' => 'https://www.facebook.com/polaris-aire-acondicionado',
                'comments' => 'Minisplits de 2 toneladas en especial'
            ],
        ];

        foreach ($businesses as $business) {
            $newBusiness = Business::create($business);

            $newBusiness->location()->create(
                Location::factory()->make()->toArray()
            );
        }
    }
}
