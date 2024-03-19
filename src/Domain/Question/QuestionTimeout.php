<?php

namespace Core\Domain\Question;

use DateTimeImmutable;

final readonly class QuestionTimeout
{
    public function __construct(
        private readonly DateTimeImmutable $timeout,
        private readonly DateTimeImmutable $checkPerformedAt,
    ) {
    }

    public function hasTimedOut(): bool
    {
        return $this->checkPerformedAt > $this->timeout;
    }
}
