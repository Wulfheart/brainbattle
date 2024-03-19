<?php

namespace Tests\Unit\Core\Domain\Event;

use Core\Domain\Event\GameFinishedEvent;
use Core\Domain\ValueObjects\GameId;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(GameFinishedEvent::class)]
class GameFinishedEventTest extends TestCase
{
    public function test_constructor(): void
    {
        $gameId = GameId::make();

        $event = new GameFinishedEvent($gameId);

        $this->assertSame($gameId, $event->gameId);
    }
}
