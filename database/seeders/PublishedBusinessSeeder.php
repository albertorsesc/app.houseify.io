<?php

namespace Database\Seeders;

use App\Models\Businesses\Business;
use App\Models\Location;
use App\Models\User;
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
                'name' => 'Escareño Ramos y Asociados',
                'categories' => ['Constructora'],
                'email' => 'escarenoramos1@hotmail.com',
                'phone' => '6865822009',
            ],
           /* [
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
                'linkedin_profile' => 'https://www.linkedin.com/polaris-aire-acondicionado',
                'comments' => 'Minisplits de 2 toneladas en especial'
            ],*/
        ];
        $newBusiness = Business::create($businesses[0]);
        $newBusiness->location()->create([
            'address' => 'Columnistas #999',
            'neighborhood' => 'Ignacio Allende',
            'city' => 'Mexicali',
            'state_id' => 2,
            'zip_code' => '21390'
        ]);

        $newBusiness->update(['status' => true]);

        /*foreach ($businesses as $business) {
            $newBusiness = Business::create($business);

            $newBusiness->location()->create(
                Location::factory()->make()->toArray()
            );

            $newBusiness->update(['status' => true]);
        }*/
    }
}
