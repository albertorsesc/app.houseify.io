<?php

namespace Tests\Unit\Models\Forum;

use App\Inspections\Spam;
use Tests\TestCase;

class SpamTest extends TestCase
{
    /**
     * @test
     * @throws \Throwable
    */
    public function it_checks_for_any_key_held_down()
    {
        $spam = new Spam();

        $this->expectException(\Exception::class);

        $spam->detect('Hello world aaaaaaaaaa');
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function it_validates_spam()
    {
        $spam = new Spam();

        $this->expectException(\Exception::class);

        $spam->detect('yahoo customer support');
    }
}
