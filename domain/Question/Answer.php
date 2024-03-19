<?php

namespace Domain\Question;

final readonly class Answer
{
    public function __construct(
        public AnswerId $id,
        public string $answerText,
        public bool $isCorrect,
        public bool $isSelectedByInvitingPlayer,
        public bool $isSelectedByInvitedPlayer
    )
    {
    }
}
