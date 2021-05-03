<?php

namespace App\Models\Forum\Threads;

use App\Models\User;
use App\Models\Forum\Thread;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['body'];

    protected static function boot ()
    {
        parent::boot();
        self::creating(function ($reply) {
            $reply->author_id = auth()->id();
        });
    }

    /* Relations */

    public function thread() : BelongsTo
    {
        return $this->belongsTo(Thread::class);
    }

    public function author() : BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
