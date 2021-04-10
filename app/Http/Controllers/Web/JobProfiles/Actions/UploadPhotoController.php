<?php

namespace App\Http\Controllers\Web\JobProfiles\Actions;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobProfiles\JobProfile;

class UploadPhotoController extends Controller
{
    public function __invoke (Request $request, JobProfile $jobProfile) : \Illuminate\Http\RedirectResponse
    {
        if ($jobProfile->photo) {
            \Storage::delete($jobProfile->photo);
        }

        $photoName = $jobProfile->uuid . '-' . md5(Str::slug(now()->toDateTimeString())) . '.' . 'png';
        $path = '/public/images/';

        try {
            \Storage::putFileAs($path, $request->photo, $photoName);
        } catch (Exception $exception) {
            \Log::error($exception->getMessage());
            return response()
                ->redirectTo('web.job-profiles.show', $jobProfile)
                ->withErrors(['photo' => 'Ocurrio un error al guardar el archivo, intente utilizar otra imágen.']);
        }

        $jobProfile->update([
            'photo' => $path . $photoName
        ]);

        return response()->redirectTo(route('web.job-profiles.show', $jobProfile));
    }
}
