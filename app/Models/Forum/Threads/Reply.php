<?php

namespace App\Models\Forum\Threads;

use App\Models\User;
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
        self::creating(fn ($reply) => $reply->author_id = auth()->id());
        self::deleting(fn ($reply) => $reply->isBest() ? $reply->thread->update(['best_reply_id' => null]) : null);
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

    /* Helpers */

    public function isBest() : bool
    {
        return (int) $this->thread->best_reply_id === $this->id;
    }
}
