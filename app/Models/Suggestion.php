<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    protected $fillable = ['module', 'subject', 'body'];

    protected static function boot ()
    {
        parent::boot();
        self::creating(fn ($suggestion) => $suggestion->suggester_id = auth()->id());
    }
}
