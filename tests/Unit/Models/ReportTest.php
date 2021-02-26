<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Report;

class ReportTest extends TestCase
{
    /**
     *   @test
     *   @throws \Throwable
     *   Not testing relationship instead validating model has user method,
     *   otherwise Report instance would depend on other model to assertInstanceOf.
     */
    public function report_belongs_to_user()
    {
        $this->assertTrue(
            method_exists((new Report), 'user')
        );
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function report_morphs_to_reportable()
    {
        $this->assertTrue(
            method_exists((new Report), 'reportable')
        );
    }
}
