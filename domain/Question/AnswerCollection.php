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


}
