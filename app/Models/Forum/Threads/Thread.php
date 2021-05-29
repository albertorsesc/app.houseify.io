<?php

namespace App\Models\Forum\Threads;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Concerns\SerializeTimestamps;
use Illuminate\Database\Eloquent\{Model, Relations\BelongsTo, Factories\HasFactory, Relations\HasMany};

class Thread extends Model
{
    use HasFactory, SerializeTimestamps;

    const PUBLISHED_STATUS = true;

    protected $fillable = ['slug', 'title', 'body', 'channel_id', 'best_reply_id', 'author_id'];

    protected static function boot ()
    {
        parent::boot();
        self::creating(function ($thread) {
            $thread->author_id = auth()->id();
        });
        self::created(function ($thread) {
            $thread->update(['slug' => $thread->title]);
        });
    }

    public function getRouteKeyName () : string
    {
        return 'slug';
    }

    /* Relations */

    public function channel() : BelongsTo
    {
        return $this->belongsTo(ThreadChannel::class);
    }

    public function author() : BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function replies() : HasMany
    {
        return $this->hasMany(Reply::class)->latest('updated_at');
    }

    /* Mutators */

    public function setSlugAttribute($value)
    {
        $slug = Str::slug($value);
        if (static::whereSlug($slug)->exists()) {
            $slug = "$slug-$this->id";
        }
        $this->attributes['slug'] = $slug;
    }

    /* Helpers */

    public function profile() : string
    {
        return route('web.threads.show', [$this->channel, $this]);
    }

    public function toggleBestReply(Reply $reply)
    {
        if ($this->best_reply_id === $reply->id) {
            $this->update(['best_reply_id' => null]);
        } else {
            $this->update(['best_reply_id' => $reply->id]);
        }
    }
}
