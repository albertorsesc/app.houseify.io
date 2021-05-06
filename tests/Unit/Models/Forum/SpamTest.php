<?php

namespace Tests\Unit\Models\Forum;

use PHPUnit\Framework\TestCase;

class SpamTest extends TestCase
{
    /**
     * @test
     * @throws \Throwable
    */
    public function it_validates_spam()
    {
        $spam = new \App\Models\Concerns\SpamDetection\Spam();

        $this->assertFalse($spam->detect('Innocent reply here'));
    }
}
