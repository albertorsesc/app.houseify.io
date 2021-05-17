<?php

namespace App\Models;

use App\Models\Concerns\InterventionImage\Filters\MediumFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Media extends Model
{
    use HasFactory;

    protected $touches = ['mediable'];
    protected $fillable = ['file_name', 'mediable_id', 'mediable_type'];

    public function mediable() : \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function getFullUrl()
    {
        return \Storage::url($this->file_name);
    }
}
