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
            'Albañilería',
            'Arquitectura',
            'Carpintería',
            'Cerrajería',
            'Constructora',
            'Decoración',
            'Eléctrica',
            'Electrodomésticos',
            'Energías Renovables',
            'Ferretería',
            'Grúas',
            'Herrería',
            'Inmobiliaria',
            'Pintura',
            'Plomería',
            'Jardinería',
            'Tapicería',
            'Vidriería',
            'Maquinaria de Construcción',
            'Material de Construcción'
        ], config('houseify.construction_categories'));
    }
}
