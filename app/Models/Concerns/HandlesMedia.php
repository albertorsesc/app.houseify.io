<?php

namespace App\Models\Concerns;

use App\Models\Media;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

trait HandlesMedia {

    // Relationship
    public function media () : \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    /* Get Media */

    public function getMedia($size = null)
    {
        return $this->media->pluck('file_name');
        /*return collect($this->media->pluck('file_name'))->map(function ($image) use ($size) {
            return 'img/' . $size . '/' . Str::after($image, 'public/');
        })->toArray();*/
    }

    public function getOriginalMedia ()
    {
        return $this->media;
    }

    /** Attach Image to Model
     *
     * @param string $image
     */
    public function attachImage(string $image)
    {
        $this->media()->create([
            'file_name' => $image
        ]);
    }

    /** Attach Image to Model
     *
     * @method
     * @param UploadedFile $file
     * @param string $modelDirectory
     *
     */
    public function uploadImage(UploadedFile $file, string $modelDirectory)
    {
        self::attachImage(
            $img = $file->storePublicly('public')
        );

//        'public/' .
//        $this->seller->getUsername() . '/' .
//        static::getPluralModelName($this) . '/' .
//        Str::limit(base64_encode($modelDirectory), 20, '')
    }

    public function deleteMedia ($mediaId)
    {
        $this->media()->find($mediaId)->delete();
    }

    public static function crypt(string $string)
    {
        return Str::limit(\Crypt::encrypt($string));
    }

    public static function limitedHash(string $string)
    {
        return Str::limit(hash('sha256', $string),20, '');
    }

    public static function getPluralModelName($model)
    {
        return Str::plural(Str::lower(class_basename($model)));
    }

    public function getAcceptedExtensions()
    {
        return ['jpeg', 'png'];
    }
}
