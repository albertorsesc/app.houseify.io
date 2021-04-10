<?php

namespace App\Services\GeoLocations\Mexico;

use Illuminate\Support\Facades\Http;

class SepomexApi
{
    const METHODS = [
        'city-by-state' => 'get_municipio_por_estado',
        'neighborhoods-by-city' => 'get_colonia_por_municipio',
    ];

    public function getCitiesByState($stateName)
    {
        return Http::get(
            $this->getEndpoint(self::METHODS['city-by-state'], urldecode($stateName))
        )['response']['municipios'];
    }

    public function getNeighborhoodsByCity($cityName)
    {
        return Http::get(
            $this->getEndpoint(self::METHODS['neighborhoods-by-city'], $cityName)
        )['response']['colonia'];
    }

    public function getEndpoint($method, $query) : string
    {
        return config('sepomex.url') . $method . '/' . $query . '?token=' . config('sepomex.token');
    }
}
