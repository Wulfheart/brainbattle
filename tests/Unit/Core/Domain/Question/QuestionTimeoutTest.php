<?php

namespace Tests\Unit\Core\Domain\Question;

use Core\Domain\Question\QuestionTimeout;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(QuestionTimeout::class)]
class QuestionTimeoutTest extends TestCase
{
    public function test_hasTimedOut(): void
    {
        $time = new DateTimeImmutable();
        $timeout = new QuestionTimeout($time, $time);

        $this->assertFalse($timeout->hasTimedOut());

        $timeout = new QuestionTimeout($time, $time->modify('+1 second'));
        $this->assertTrue($timeout->hasTimedOut());
    }
}
