<?php

namespace Core\Domain\Exception;

use Exception;

final class PlayerIsNotInvitingPlayerException extends Exception
{
    public function __construct(
        string $playerId,
        string $gameId
    ) {
        parent::__construct("Player $playerId is not the InvitingPlayer in game $gameId");
    }
}
