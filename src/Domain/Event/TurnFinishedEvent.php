<?php

namespace Core\Domain\Event;

use Core\Domain\Player\PlayerTypeEnum;
use Core\Domain\ValueObjects\GameId;

final class TurnFinishedEvent
{
    public function __construct(
        public GameId $gameId,
        public PlayerTypeEnum $playerType,
    )
    {

    }
}
