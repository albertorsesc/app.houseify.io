<?php

namespace Database\Seeders;

use App\Models\Forum\Threads\ThreadChannel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ThreadChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channels = [
            [
                'name' => 'Aire Acondicionado',
                'slug' => Str::slug('Aire Acondicionado'),
            ],
            [
                'name' => 'Albañilería',
                'slug' => Str::slug('Albañilería'),
            ],
            [
                'name' => 'Arquitectura',
                'slug' => Str::slug('Arquitectura'),
            ],
            [
                'name' => 'Carpintería',
                'slug' => Str::slug('Carpintería'),
            ],
            [
                'name' => 'Cerrajería',
                'slug' => Str::slug('Cerrajería'),
            ],
            [
                'name' => 'Constructora',
                'slug' => Str::slug('Constructora'),
            ],
            [
                'name' => 'Decoración',
                'slug' => Str::slug('Decoración'),
            ],
            [
                'name' => 'Eléctrica',
                'slug' => Str::slug('Eléctrica'),
            ],
            [
                'name' => 'Electrodomésticos',
                'slug' => Str::slug('Electrodomésticos'),
            ],
            [
                'name' => 'Ferretería',
                'slug' => Str::slug('Ferretería'),
            ],
            [
                'name' => 'Grúas',
                'slug' => Str::slug('Grúas'),
            ],
            [
                'name' => 'Herrería',
                'slug' => Str::slug('Herrería'),
            ],
            [
                'name' => 'Inmobiliaria',
                'slug' => Str::slug('Inmobiliaria'),
            ],
            [
                'name' => 'Pintura',
                'slug' => Str::slug('Pintura'),
            ],
            [
                'name' => 'Plomería',
                'slug' => Str::slug('Plomería'),
            ],
            [
                'name' => 'Jardinería',
                'slug' => Str::slug('Jardinería'),
            ],
            [
                'name' => 'Tapicería',
                'slug' => Str::slug('Tapicería'),
            ],
            [
                'name' => 'Vidriería',
                'slug' => Str::slug('Vidriería'),
            ],
            [
                'name' => 'Material de Construcción',
                'slug' => Str::slug('Material de Construcción'),
            ],
        ];

        ThreadChannel::insert($channels);
    }
}
