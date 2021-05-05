<?php

namespace App\Http\Controllers\Api\Properties;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Properties\Property;
use Illuminate\Http\Request;

class PropertyImageController extends Controller
{
    public function store(Request $request, Property $property)
    {
        if ($property->media()->count() >= 15) {
            return response()->json(['error' => 'Alcanzaste el numero maximo de Imágenes para esta Propiedad :/'], 422);
        }
        $request->validate([
            'images.*' => ['mimes:jpeg,png,jpg']
        ]);

        foreach ($request->images as $image) {
            $property->uploadImage($image, $property->slug);
        }
        $property->touch();
        return response()->json($property->media, 201);
    }

    public function destroy(Property $property, Media $media)
    {
        $property->deleteMedia($media->id);

        return response([], 204);
    }
}
