<?php

namespace App\Models\Concerns;

use App\Models\Interest;

trait Interestable
{

    //    protected static function bootInterestableTrait()
    //    {
    //        static::deleting(function ($model) {
    //            $model->favorites->each->delete();
    //        });

    //    }

    public function interests()
    {
        return $this->morphMany(Interest::class, 'interestable');
    }

    /** Accessors */

    public function getInterestCountAttribute()
    {
        return $this->interests->count();
    }

    public function getIsInterestedAttribute() : bool
    {
        return !! $this->interests()->where('user_id', auth()->id())->count();
    }

    /** Helpers */

    public function interested()
    {
        return $this->interests()->firstOrCreate(['user_id' => auth()->id()]);
    }

    public function uninterested()
    {
        $this->interests()->where(['user_id' => auth()->id()])->delete();
    }
}
