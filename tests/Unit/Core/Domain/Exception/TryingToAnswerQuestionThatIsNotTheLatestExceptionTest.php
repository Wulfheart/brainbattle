<?php

namespace Tests\Unit\Core\Domain\Exception;

use Core\Domain\Exception\TryingToAnswerQuestionThatIsNotTheLatestException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(TryingToAnswerQuestionThatIsNotTheLatestException::class)]
class TryingToAnswerQuestionThatIsNotTheLatestExceptionTest extends TestCase
{
    public function test_forInvitingPlayer(): void
    {
        $exception = TryingToAnswerQuestionThatIsNotTheLatestException::forInvitingPlayer();
        $this->assertEquals(
            'Latest unanswered question is not the one being answered for inviting player',
            $exception->getMessage()
        );
        $this->assertEquals(1, $exception->getCode());
    }
    public function test_forInvitedPlayer(): void
    {
        $exception = TryingToAnswerQuestionThatIsNotTheLatestException::forInvitedPlayer();
        $this->assertEquals(
            'Latest unanswered question is not the one being answered for invited player',
            $exception->getMessage()
        );
        $this->assertEquals(2, $exception->getCode());
    }
}
