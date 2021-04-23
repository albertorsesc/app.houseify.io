<?php

namespace App\Models;

use App\Events\Reports\NewReportSubmitted;
use Illuminate\Database\Eloquent\{
    Model,
    Factories\HasFactory,
    Relations\BelongsTo,
    Relations\MorphTo
};

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'reportable_id', 'reportable_type', 'reporting_cause', 'comments'];

    protected static function booted ()
    {
        self::created(function ($report) {
            NewReportSubmitted::dispatch($report);
        });
    }

    /** Relations */

    public function reportable() : MorphTo
    {
        return $this->morphTo();
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
