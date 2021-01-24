<?php

namespace Tests\Unit\Config;

use Tests\TestCase;

class HouseifyConfigFileTest extends TestCase
{
    /**
     * @test
     * @throws \Throwable
     */
    public function construction_categories_exist_in_houseify_config()
    {
        $this->assertSame([
            'Ferreteria',
            'Electricidad',
            'Pintura',
            'Plomeria',
        ], config('houseify.construction_categories'));
    }
}
