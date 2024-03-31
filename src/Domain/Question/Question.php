<?php

namespace Core\Domain\Question;

use Core\Domain\Exception\QuestionAlreadyAnsweredException;

final readonly class Question
{
    public function __construct(
        public QuestionId $id,
        public string $questionText,
        public AnswerCollection $answerCollection,
        public ?QuestionTimeout $invitingPlayerTimeout = null,
        public ?QuestionTimeout $invitedPlayerTimeout = null,
    ) {
    }

    public function hasBeenFinishedByInvitingPlayer(): bool
    {
        return $this->invitingPlayerTimeout?->hasTimedOut() || $this->answerCollection->hasASelectedAnswerFromInvitingPlayer();
    }

    public function hasBeenFinishedByInvitedPlayer(): bool
    {
        return $this->invitedPlayerTimeout?->hasTimedOut() || $this->answerCollection->hasASelectedAnswerFromInvitedPlayer();
    }

    /**
     * @throws QuestionAlreadyAnsweredException
     */
    public function answerForInvitingPlayer(AnswerId $answerId): void
    {
        if($this->hasBeenFinishedByInvitingPlayer()) {
            throw QuestionAlreadyAnsweredException::invitingPlayer();
        }
        $this->answerCollection->answerForInvitingPlayer($answerId);
    }

    /**
     * @throws QuestionAlreadyAnsweredException
     */
    public function answerForInvitedPlayer(AnswerId $answerId): void
    {
        if($this->hasBeenFinishedByInvitedPlayer()) {
            throw QuestionAlreadyAnsweredException::invitedPlayer();
        }
        $this->answerCollection->answerForInvitedPlayer($answerId);
    }
}
