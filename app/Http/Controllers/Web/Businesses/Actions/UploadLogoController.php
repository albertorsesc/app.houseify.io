<?php

namespace App\Http\Controllers\Web\Businesses\Actions;

use App\Http\Controllers\Controller;
use App\Models\Businesses\Business;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class UploadLogoController extends Controller
{
    public function __invoke (Request $request, Business $business)
    {
        if ($business->logo) {
            \Storage::delete($business->logo);
        }

        $logoName = $business->slug . '-' . Str::slug(sha1(now())) . '.' . 'png';
        $path = '/public/images/';
        try {
            \Storage::putFileAs($path, $request->logo, $logoName);
        } catch (Exception $exception) {
            \Log::error($exception->getMessage());
            return response()
                ->redirectTo(route('web.businesses.show', $business))
                ->withErrors(['logo' => 'Ocurrio un error al guardar el archivo, intente utilizar otra imagen.']);
        }

        $business->update([
            'logo' => $path . $logoName
        ]);

        return response()->redirectTo(route('web.businesses.show', $business));
    }
}
