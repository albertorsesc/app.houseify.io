<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

/**
 * @method static isPublished
 */
trait Publishable
{

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeIsPublished(Builder $query) : Builder
    {
        return $query->where('status', 1);
    }

    public function toggle()
    {
//        tap($this, fn($model) => $model->status = ! $model->status)->update();
        $this->status = ! $this->status;
        $this->save();
    }

    /*
     * string $as refers to the FK on the Model.
     * */
    public function wasCreatedByAuth (string $as) : bool
    {
        return $this->$as === auth()->id();
    }

    public function unpublish ()
    {
        $this->update(['status' => false]);
    }
}
