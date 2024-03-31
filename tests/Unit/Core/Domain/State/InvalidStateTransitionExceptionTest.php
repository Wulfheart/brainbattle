<?php

namespace Tests\Unit\Core\Domain\State;

use Core\Domain\State\InvalidStateTransitionException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(InvalidStateTransitionException::class)]
class InvalidStateTransitionExceptionTest extends TestCase
{
    public function test_message(): void
    {
        $exception = new InvalidStateTransitionException('fromState', 'toState');
        $this->assertEquals('Invalid state transition from fromState to toState', $exception->getMessage());
    }
}
