<?php

namespace App\Models\Forum\Threads;

use App\Models\User;
use App\Models\Forum\Threads\Reply;
use App\Models\Concerns\SerializeTimestamps;
use Illuminate\Database\Eloquent\{Model, Relations\BelongsTo, Factories\HasFactory, Relations\HasMany};

class Thread extends Model
{
    use HasFactory, SerializeTimestamps;

    const PUBLISHED_STATUS = true;

    protected $fillable = ['title', 'body', 'channel', 'best_reply_id'];

    protected static function boot ()
    {
        parent::boot();
        self::creating(fn ($thread) => $thread->author_id = auth()->id());
    }

    /* Relations */

    public function author() : BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function replies() : HasMany
    {
        return $this->hasMany(Reply::class)->latest('updated_at');
    }

    /* Helpers */

    public function toggleBestReply(Reply $reply)
    {
        if ($this->best_reply_id === $reply->id) {
            $this->update(['best_reply_id' => null]);
        } else {
            $this->update(['best_reply_id' => $reply->id]);
        }
    }
}
