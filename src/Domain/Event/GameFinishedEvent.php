<?php

namespace Core\Domain\Event;

use Core\Domain\ValueObjects\GameId;

final class GameFinishedEvent
{
    public function __construct(
        public GameId $gameId,
    )
    {

    }

}
