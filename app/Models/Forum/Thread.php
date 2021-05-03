<?php

namespace App\Models\Forum;

use App\Models\User;
use App\Models\Forum\Threads\Reply;
use Illuminate\Database\Eloquent\{Model, Relations\BelongsTo, Factories\HasFactory, Relations\HasMany};

class Thread extends Model
{
    use HasFactory;

    const PUBLISHED_STATUS = true;

    protected $fillable = ['title', 'body', 'author_id'];

    protected static function boot ()
    {
        parent::boot();
        self::creating(function ($thread) {
            $thread->author_id = auth()->id();
        });
    }

    /* Relations */

    public function author() : BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function replies() : HasMany
    {
        return $this->hasMany(Reply::class);
    }
}
