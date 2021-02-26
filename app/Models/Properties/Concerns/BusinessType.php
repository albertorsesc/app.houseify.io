<?php

namespace App\Models\Properties\Concerns;

use Illuminate\Support\Collection;

class BusinessType
{
    const TYPES = [
        'sale' => 'venta',
        'rent' => 'renta',
        'transfer' => 'traspaso',
    ];

    public static function all() : Collection
    {
        return collect([
            self::TYPES['sale'],
            self::TYPES['rent'],
            self::TYPES['transfer'],
        ]);
    }
}
