<?php

namespace Domain\Event;

use Domain\ValueObjects\GameId;

final class GameFinishedEvent
{
    public function __construct(
        public GameId $gameId,
    )
    {

    }

}
