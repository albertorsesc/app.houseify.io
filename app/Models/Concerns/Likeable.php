<?php

namespace App\Models\Concerns;

use App\Models\Like;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Likeable
{
    public function likes() : MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function liked($liked = true)
    {
//        if (! $this->hasLikeByAuth($liked)) {
        $belongsToAuth = $this->likes()->where('liked_by', auth()->id());
        if ($belongsToAuth->exists()) {
            if ($belongsToAuth->first()->liked == $liked) {
                $belongsToAuth->delete();
            } else {
                $this->likes()->update([
                    'liked_by' => auth()->id(),
                    'liked' => $liked
                ]);
            }
        } else {
            $this->likes()->create([
                'likeable_id' => $this->id,
                'likeable_type' => get_class($this),
                'liked_by' => auth()->id(),
                'liked' => $liked
            ]);
        }

        //        } else {
//            $this->likes()
//                 ->where('liked_by', auth()->id())
//                 ->where('liked', $liked)
//                 ->orWhere('liked', ! $liked)
//                 ->first()
//                 ->delete();
//        }
    }

    public function disliked()
    {
        $this->liked(false);
    }

    public function hasLikeByAuth($liked = true) : bool
    {
        return $this->likes()
                    ->where('liked_by', auth()->id())
                   ->where(function (Builder $query) use ($liked) {
                       $query
                           ->where('liked', $liked)
                           ->orWhere('liked', ! $liked);
                   })
                   ->exists();
    }

}
