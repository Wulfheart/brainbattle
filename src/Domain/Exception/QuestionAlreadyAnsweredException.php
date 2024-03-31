<?php

namespace Core\Domain\Exception;

use Exception;

final class QuestionAlreadyAnsweredException extends Exception
{
    public const int REASON_INVITED_PLAYER = 1;

    public const int REASON_INVITING_PLAYER = 2;

    public static function invitedPlayer(): self
    {
        return new self('The invited player has already answered the question.', self::REASON_INVITED_PLAYER);
    }

    public static function invitingPlayer(): self
    {
        return new self('The inviting player has already answered the question.', self::REASON_INVITING_PLAYER);
    }
}
