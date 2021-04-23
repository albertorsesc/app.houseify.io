<?php

namespace App\Models\Concerns;

use App\Models\Report;

trait CanBeReported
{
    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function report(array $data)
    {
        $this->reports()->create([
            'user_id' => auth()->id(),
            'reporting_cause' => $data['reporting_cause'],
            'comments' => $data['comments'] ?? null,
        ]);
    }

    /**
     * Must be implemented in Model using trait with causes of report.
     * @return array
     * @example ['offensive' => 'Offensive Content']
     */
    public static function getReportingCauses() : array
    {
        return [];
    }
}
