<?php

namespace Domain\Question;

final class QuestionCollection
{
    public function __construct(
        public Question $question1,
        public Question $question2,
        public Question $question3,
    )
    {
    }
}
