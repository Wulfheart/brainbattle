<?php

namespace Domain\Question;

final readonly class Question
{
    public function __construct(
        public QuestionId $id,
        public string $questionText,
        public AnswerCollection $answerCollection,
        public ?QuestionTimeout $invitingPlayerTimeout = null,
        public ?QuestionTimeout $invitedPlayerTimeout = null,
    )
    {
    }

    public function hasBeenFinishedByInvitingPlayer(): bool
    {
        return $this->invitingPlayerTimeout->hasTimedOut() || $this->answerCollection->hasASelectedAnswerFromInvitingPlayer();
    }

    public function hasBeenFinishedByInvitedPlayer(): bool
    {
        return $this->invitedPlayerTimeout->hasTimedOut() || $this->answerCollection->hasASelectedAnswerFromInvitedPlayer();
    }

    public function answerForInvitingPlayer(AnswerId $answerId): void
    {
        $this->answerCollection->answerForInvitingPlayer($answerId);
    }

    public function answerForInvitedPlayer(AnswerId $answerId): void
    {
        $this->answerCollection->answerForInvitedPlayer($answerId);
    }
}
