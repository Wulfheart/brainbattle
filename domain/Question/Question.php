<?php

namespace Domain\Question;

final readonly class Question
{
    public function __construct(
        public QuestionId $id,
        public string $questionText
    )
    {
    }
}
