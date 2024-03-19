<?php

namespace Domain\Exception;

use Exception;

final class PlayerIsNotInvitedPlayerException extends Exception
{
    public function __construct(
        string $playerId,
        string $gameId
    ) {
        parent::__construct("Player $playerId is not the InvitedPlayer in $gameId");
    }
}
