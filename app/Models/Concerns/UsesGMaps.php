<?php

namespace App\Models\Concerns;

trait UsesGMaps
{
    public function getCoordinates() : array
    {
        if (app()->environment('testing')) {
            return [
                "latitude" => 39.0234301,
                "longitude" => -94.70188999999999
            ];
        }

        $googleMapsUrl = 'https://maps.googleapis.com/maps/api/geocode/json?address=' .
            urlencode($this->getFullAddress(true)) .
            '&key=' .
            config('services.google.gmaps_api');

        $googleMapsJson = file_get_contents($googleMapsUrl);

        $googleMapsArray = json_decode($googleMapsJson, true);

        if (count($googleMapsArray['results']) > 0) {
            $latitude = $googleMapsArray['results'][0]['geometry']['location']['lat'];
            $longitude = $googleMapsArray['results'][0]['geometry']['location']['lng'];
            return ['latitude' => $latitude, 'longitude' => $longitude];
        }
        return [];
    }

    public static function bootUsesGMaps()
    {
        if (env('GOOGLE_MAPS_ON') || app()->environment('production')) {
            self::creating(function($model) {
                $model->coordinates = $model->getCoordinates();
            });
        }
    }

    public function getGoogleMap() : ?string
    {
        if (! $this->google_map_url && $this->coordinates) {
            return "https://www.google.com/maps/?q={$this->coordinates['latitude']},{$this->coordinates['longitude']}";
        }
        if ($this->google_map_url) {
            return $this->google_map_url;
        }
        return null;
    }

}
