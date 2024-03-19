<?php

namespace Tests\Unit\Core\Domain\Event;

use Core\Domain\Event\TurnFinishedEvent;
use Core\Domain\Player\PlayerTypeEnum;
use Core\Domain\ValueObjects\GameId;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(TurnFinishedEvent::class)]
class TurnFinishedEventTest extends TestCase
{
    public function test_constructor()
    {
        $gameId = GameId::make();
        $playerType = PlayerTypeEnum::INVITING;

        $event = new TurnFinishedEvent($gameId, $playerType);

        $this->assertSame($gameId, $event->gameId);
        $this->assertSame($playerType, $event->playerType);
    }
}
