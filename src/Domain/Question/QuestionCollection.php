<?php

namespace Core\Domain\Question;

use Core\Domain\Exception\QuestionAlreadyAnsweredException;
use Core\Domain\Exception\QuestionNotFoundException;
use Core\Domain\Exception\TryingToAnswerQuestionThatIsNotTheLatestException;

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

    /**
     * @throws QuestionNotFoundException
     * @throws TryingToAnswerQuestionThatIsNotTheLatestException
     * @throws QuestionAlreadyAnsweredException
     */
    public function answerQuestionForInvitingPlayer(QuestionId $questionId, AnswerId $answerId): void
    {
        foreach ($this->questions as $question) {
            if (! $question->hasBeenFinishedByInvitingPlayer()) {
                if (! $question->id->equals($questionId)) {
                    throw TryingToAnswerQuestionThatIsNotTheLatestException::forInvitingPlayer();
                }

                $question->answerForInvitingPlayer($answerId);

                return;
            }
        }

        // @codeCoverageIgnoreStart
        // Should be unreachable
        throw QuestionNotFoundException::withId($questionId);
        // @codeCoverageIgnoreEnd
    }

    /**
     * @throws QuestionNotFoundException
     * @throws QuestionAlreadyAnsweredException
     * @throws TryingToAnswerQuestionThatIsNotTheLatestException
     */
    public function answerQuestionForInvitedPlayer(QuestionId $questionId, AnswerId $answerId): void
    {
        foreach ($this->questions as $question) {
            if (! $question->hasBeenFinishedByInvitedPlayer()) {
                if (! $question->id->equals($questionId)) {
                    throw TryingToAnswerQuestionThatIsNotTheLatestException::forInvitedPlayer();
                }

                $question->answerForInvitedPlayer($answerId);

                return;
            }
        }
        // @codeCoverageIgnoreStart
        // Should be unreachable
        throw QuestionNotFoundException::withId($questionId);
        // @codeCoverageIgnoreEnd
    }
}
