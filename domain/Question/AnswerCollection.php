<?php

namespace Domain\Question;

final readonly class AnswerCollection
{
    public function __construct(
        /** @var array<Answer> $answers */
        private array $answers
    )
    {
    }

    /**
     * @return array<Answer>
     */
    public function getAnswersInRandomOrder(): array
    {
        $keys = array_keys($this->answers);
        shuffle($keys);

        $shuffled = [];
        foreach ($keys as $key) {
            $shuffled[$key] = $this->answers[$key];
        }

        return $shuffled;
    }

    public function hasASelectedAnswerFromInvitingPlayer(): bool
    {
        foreach ($this->answers as $answer) {
            if ($answer->isSelectedByInvitingPlayer) {
                return true;
            }
        }

        return false;
    }

    public function hasASelectedAnswerFromInvitedPlayer(): bool
    {
        foreach ($this->answers as $answer) {
            if ($answer->isSelectedByInvitedPlayer) {
                return true;
            }
        }

        return false;
    }

    public function answerForInvitingPlayer(AnswerId $answerId): void
    {
        foreach ($this->answers as $answer) {
            if ($answer->id->equals($answerId)) {
                $answer->isSelectedByInvitingPlayer = true;
                return;
            }
        }
        throw new \InvalidArgumentException("Answer $answerId not found");
    }

    public function answerForInvitedPlayer(AnswerId $answerId): void
    {
        foreach ($this->answers as $answer) {
            if ($answer->id->equals($answerId)) {
                $answer->isSelectedByInvitedPlayer = true;
                return;
            }
        }
        throw new \InvalidArgumentException("Answer $answerId not found");
    }


}
