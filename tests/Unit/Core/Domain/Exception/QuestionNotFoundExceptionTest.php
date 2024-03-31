<?php

namespace Tests\Unit\Core\Domain\Exception;

use Core\Domain\Exception\QuestionNotFoundException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(QuestionNotFoundException::class)]
class QuestionNotFoundExceptionTest extends TestCase
{
    public function test_message(): void
    {
        $exception = QuestionNotFoundException::withId('foo');
        $this->assertEquals('Question with id foo not found', $exception->getMessage());
    }
}
