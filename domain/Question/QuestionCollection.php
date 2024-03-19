<?php

namespace Domain\Question;

final readonly class QuestionCollection
{
    public function __construct(
        /** @var array<Question> $questions */
        private array $questions,
    ) {
    }

    public function hasBeenFinishedByInvitingPlayer(): bool
    {
        foreach ($this->questions as $question) {
            if (! $question->hasBeenFinishedByInvitingPlayer()) {
                return false;
            }
        }

        return true;
    }

    public function hasBeenFinishedByInvitedPlayer(): bool
    {
        foreach ($this->questions as $question) {
            if (! $question->hasBeenFinishedByInvitedPlayer()) {
                return false;
            }
        }

        return true;
    }

    public function answerQuestionForInvitingPlayer(QuestionId $questionId, AnswerId $answerId): void
    {
        foreach ($this->questions as $question) {
            if (! $question->hasBeenFinishedByInvitingPlayer()) {
                if (! $question->id->equals($questionId)) {
                    throw new \InvalidArgumentException('Latest unanswered question is not the one being answered');
                }

                $question->answerForInvitingPlayer($answerId);
            }
        }

        throw new \InvalidArgumentException("Question with id $questionId not found");
    }

    public function answerQuestionForInvitedPlayer(QuestionId $questionId, AnswerId $answerId)
    {
        foreach ($this->questions as $question) {
            if (! $question->hasBeenFinishedByInvitedPlayer()) {
                if (! $question->id->equals($questionId)) {
                    throw new \InvalidArgumentException('Latest unanswered question is not the one being answered');
                }

                $question->answerForInvitedPlayer($answerId);
            }
        }

        throw new \InvalidArgumentException("Question with id $questionId not found");
    }
}
