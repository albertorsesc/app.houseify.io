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
            'Andamios',
            'Arquitectura',
            'Cancelería',
            'Carpintería',
            'Cercos',
            'Cerrajería',
            'Cocinas',
            'Concreto',
            'Constructora',
            'Decoración',
            'Eléctrica',
            'Electrodomésticos',
            'Energías Renovables',
            'Ferretería',
            'Grúas',
            'Herrería',
            'Inmobiliaria',
            'Impermeabilizantes y Aislantes',
            'Ladrillera',
            'Losas',
            'Mamparas',
            'Maquinaria de Construcción',
            'Material de Construcción',
            'Maquinaria Ligera',
            'Pintura',
            'Plomería',
            'Renderizado',
            'Transformadores',
            'Tubería',
            'Jardinería',
            'Tapicería',
            'Vidriería',
            'Vivero',
        ], config('houseify.construction_categories'));
    }
}
