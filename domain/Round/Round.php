<?php

namespace Domain\Round;


use Domain\Question\QuestionCollection;

final readonly class Round
{
    public function __construct(
        public RoundId $id,
        public QuestionCollection $questionCollection,
    )
    {
    }
}
