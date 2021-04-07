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
            'Electricidad',
            'Ferreteria',
            'Pintura',
            'Plomeria',
            'Jardineria',
            'Vidrieria',
        ], config('houseify.construction_categories'));
    }
}
