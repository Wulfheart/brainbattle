<?php

namespace Domain\Round;


use Domain\Question\AnswerId;
use Domain\Question\Category;
use Domain\Question\QuestionCollection;
use Domain\Question\QuestionId;

final readonly class Round
{
    public function __construct(
        public RoundId $id,
        public Category $category,
        public QuestionCollection $questionCollection,
    )
    {
    }

    public static function start(
        Category $category,
        QuestionCollection $questionCollection
    )
    {
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
}
