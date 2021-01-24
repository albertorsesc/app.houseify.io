<?php

namespace App\Models\Properties\Concerns;

class BusinessType
{
    const TYPES = [
        'sale' => 'venta',
        'rent' => 'renta',
        'transfer' => 'traspaso',
    ];

    public static function all() : array
    {
        return [
            self::TYPES['sale'],
            self::TYPES['rent'],
            self::TYPES['transfer'],
        ];
    }
}
