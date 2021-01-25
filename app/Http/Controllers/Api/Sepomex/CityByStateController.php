<?php

namespace App\Http\Controllers\Api\Sepomex;

use App\Http\Controllers\Controller;
use App\Services\GeoLocations\Mexico\SepomexApi;

class CityByStateController extends Controller
{
    public SepomexApi $service;

    public function __construct (SepomexApi $service)
    {
        $this->service = $service;
    }

    public function __invoke ($state)
    {
        return $this->service->getCitiesByState($state);
    }
}
