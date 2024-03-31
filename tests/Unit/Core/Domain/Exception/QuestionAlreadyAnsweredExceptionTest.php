<?php

namespace Tests\Unit\Core\Domain\Exception;

use Core\Domain\Exception\QuestionAlreadyAnsweredException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(QuestionAlreadyAnsweredException::class)]
class QuestionAlreadyAnsweredExceptionTest extends TestCase
{
    public function test_invitedPlayer(): void
    {
        $exception = QuestionAlreadyAnsweredException::invitedPlayer();
        $this->assertEquals('The invited player has already answered the question.', $exception->getMessage());
        $this->assertEquals(1, $exception->getCode());
    }
    public function test_invitingPlayer(): void
    {
        $exception = QuestionAlreadyAnsweredException::invitingPlayer();
        $this->assertEquals('The inviting player has already answered the question.', $exception->getMessage());
        $this->assertEquals(2, $exception->getCode());
    }
}
