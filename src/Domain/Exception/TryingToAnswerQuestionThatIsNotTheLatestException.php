<?php

namespace Core\Domain\Exception;

final class TryingToAnswerQuestionThatIsNotTheLatestException extends \Exception
{
    public const int REASON_INVITING_PLAYER = 1;

    public const int REASON_INVITED_PLAYER = 2;

    public static function forInvitingPlayer(): self
    {
        return new self('Latest unanswered question is not the one being answered for inviting player', self::REASON_INVITING_PLAYER);
    }

    public static function forInvitedPlayer(): self
    {
        return new self('Latest unanswered question is not the one being answered for invited player', self::REASON_INVITED_PLAYER);
    }
}
