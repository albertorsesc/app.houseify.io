<?php

namespace App\Models\Concerns;

use App\Models\Interest;

trait Interestable
{
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
        return !! $this->interests()->where('interested_by', auth()->id())->count();
    }

    /** Helpers */

    public function interested()
    {
        $this->interests()->firstOrCreate(['interested_by' => auth()->id()]);
    }

    public function uninterested()
    {
        $this->interests()->where(['interested_by' => auth()->id()])->delete();
    }
}
