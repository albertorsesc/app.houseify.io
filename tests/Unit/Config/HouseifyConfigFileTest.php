<?php

namespace Tests\Unit\Config;

use Tests\TestCase;

class HouseifyConfigFileTest extends TestCase
{
    /**
     * @test
     * @throws \Throwable
     */
    public function construction_categories_must_exist_in_houseify_config()
    {
        $this->assertSame([
            'A/C',
            'Arquitectura',
            'Carpintería',
            'Cerrajería',
            'Constructora',
            'Decoración',
            'Eléctrica',
            'Electrodomésticos',
            'Ferretería',
            'Grúas',
            'Herrería',
            'Inmobiliaria',
            'Pintura',
            'Plomería',
            'Jardinería',
            'Tapicería',
            'Vidriería',
            'Material de Construcción'
        ], config('houseify.construction_categories'));
    }
}
