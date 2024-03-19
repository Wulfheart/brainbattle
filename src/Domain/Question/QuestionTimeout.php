<?php

namespace Core\Domain\Question;

use DateTimeImmutable;

final class QuestionTimeout
{
    public function __construct(
        private readonly DateTimeImmutable $timeout,
        private ?DateTimeImmutable $answerSubmittedAt = null
    ) {
    }

    public function hasTimedOut(): bool
    {
        if ($this->answerSubmittedAt === null) {
            return false;
        }

        return $this->answerSubmittedAt > $this->timeout;
    }

    public function submitAnswer(DateTimeImmutable $submittedAt): void
    {
        $this->answerSubmittedAt = $submittedAt;
    }
}
