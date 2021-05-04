<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
