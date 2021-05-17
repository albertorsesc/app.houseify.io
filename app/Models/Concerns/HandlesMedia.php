<?php

namespace App\Models\Concerns;

use App\Models\Concerns\InterventionImage\Filters\MediumFilter;
use App\Models\Media;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

trait HandlesMedia
{
    // Relationship
    public function media () : \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    /* Get Media */

    public function getMedia($size = null)
    {
        return $this->media()->get(['file_name']);
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
        if (app()->environment('production')) {
            $path = Str::slug(class_basename($this)) . '/' . Str::random(40)  . '.' . $file->extension();
            $img = Image::make($file)->filter(new MediumFilter)->stream()->__toString();
            Storage::disk('s3')->put($path, $img, 'public');
            self::attachImage(
                Storage::disk('s3')->url($path)
           );
         } else {
            self::attachImage(
                $file->storePublicly('public')
            );
        }

    }

    public function deleteMedia ($mediaId)
    {
        $media = $this->media()->find($mediaId);

        if (app()->environment('production')) {
            Storage::disk('s3')->delete($media->file_name);
        } else {
            Storage::delete($media->file_name);
        }
        $media->delete();
    }

    public static function crypt(string $string) : string
    {
        return Str::limit(\Crypt::encrypt($string));
    }

    public static function limitedHash(string $string) : string
    {
        return Str::limit(hash('sha256', $string),20, '');
    }

    public static function getPluralModelName($model) : string
    {
        return Str::plural(Str::lower(class_basename($model)));
    }

    public function getAcceptedExtensions() : array
    {
        return ['jpeg', 'png'];
    }
}
