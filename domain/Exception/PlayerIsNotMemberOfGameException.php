<?php

namespace Domain\Exception;

use Exception;

final class PlayerIsNotMemberOfGameException extends Exception
{
    public function __construct(
        string $playerId,
        string $gameId
    ) {
        parent::__construct("Player $playerId is not a member of game $gameId");
    }
}
