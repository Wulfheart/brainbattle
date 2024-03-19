<?php

namespace Core\Domain\Round;

use Core\Domain\Question\AnswerId;
use Core\Domain\Question\Category;
use Core\Domain\Question\QuestionCollection;
use Core\Domain\Question\QuestionId;

final readonly class Round
{
    public function __construct(
        public RoundId $id,
        public Category $category,
        public QuestionCollection $questionCollection,
    ) {
    }

    public static function start(
        Category $category,
        QuestionCollection $questionCollection
    ) {
        return new self(
            RoundId::make(),
            $category,
            $questionCollection
        );

    }

    public function hasBeenFinishedByInvitingPlayer(): bool
    {
        return $this->questionCollection->hasBeenFinishedByInvitingPlayer();
    }

    public function hasBeenFinishedByInvitedPlayer(): bool
    {
        return $this->questionCollection->hasBeenFinishedByInvitedPlayer();
    }

    public function answerQuestionForInvitingPlayer(QuestionId $questionId, AnswerId $answerId): void
    {
        $this->questionCollection->answerQuestionForInvitingPlayer($questionId, $answerId);
    }

    public function answerQuestionForInvitedPlayer(QuestionId $questionId, AnswerId $answerId): void
    {
        $this->questionCollection->answerQuestionForInvitedPlayer($questionId, $answerId);
    }
}
