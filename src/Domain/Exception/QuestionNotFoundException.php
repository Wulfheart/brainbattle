<?php

namespace Core\Domain\Exception;

final class QuestionNotFoundException extends \Exception
{
    public static function withId(string $id): self
    {
        return new self("Question with id {$id} not found");
    }
}
