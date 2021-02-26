<?php

namespace Tests\Unit\Http\Requests\Properties\Actions;

use App\Models\Properties\Property;
use Illuminate\Support\Str;
use Tests\PropertyTestCase;

class ReportPropertyRequestTest extends PropertyTestCase
{
    private $property;
    private string $routePrefix = 'api.properties.report';

    protected function setUp () : void
    {
        parent::setUp();
        $this->signIn();
        $this->property = $this->create(Property::class);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function reporting_cause_is_required()
    {
        $this->postJson(route($this->routePrefix, $this->property), [
            'reporting_cause' => null,
            'comments' => 'Some comments',
        ])->assertJsonValidationErrors('reporting_cause');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function reporting_cause_must_not_exceed_100_characters()
    {
        $this->postJson(route($this->routePrefix, $this->property), [
            'reporting_cause' => Str::random(101),
            'comments' => 'Some comments',
        ])->assertJsonValidationErrors('reporting_cause');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function comments_must_not_exceed_255_characters()
    {
        $this->postJson(route($this->routePrefix, $this->property), [
            'reporting_cause' => $this->property->getReportingCauses()['no-answer'],
            'comments' => Str::random(256),
        ])->assertJsonValidationErrors('comments');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function comments_are_required_if_reporting_cause_is_other()
    {
        $this->postJson(route($this->routePrefix, $this->property), [
            'reporting_cause' => $this->property->getReportingCauses()['other'],
            'comments' => null,
        ])->assertJsonValidationErrors('comments');
    }
}
