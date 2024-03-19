<?php

namespace Domain\Event;

use Domain\Player\PlayerTypeEnum;
use Domain\ValueObjects\GameId;

final class TurnFinishedEvent
{
    public function __construct(
        public GameId $gameId,
        public PlayerTypeEnum $playerType,
    )
    {

    }
}
