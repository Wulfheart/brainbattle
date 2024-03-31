<?php

namespace Tests\Unit\Core\Domain\Player;

use Core\Domain\Player\Player;
use Core\Domain\Player\PlayerId;
use Core\Domain\Player\PlayerTypeEnum;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Player::class)]
class PlayerTest extends TestCase
{
    public function test_equals_returns_true(): void
    {
        $player = new Player(PlayerId::make(), 'GAME_ID', PlayerTypeEnum::INVITED);
        $otherPlayer = $player;

        $this->assertTrue($player->equals($otherPlayer));
    }

    public function test_equals_returns_false(): void
    {
        $playerId = PlayerId::make();
        $player = new Player($playerId, 'GAME_ID', PlayerTypeEnum::INVITED);

        $otherPlayer = new Player(PlayerId::make(), 'GAME_ID', PlayerTypeEnum::INVITED);
        $this->assertFalse($player->equals($otherPlayer));

        $otherPlayer = new Player($playerId, 'GAME_ID2', PlayerTypeEnum::INVITED);
        $this->assertFalse($player->equals($otherPlayer));

        $otherPlayer = new Player($playerId, 'GAME_ID', PlayerTypeEnum::INVITING);
        $this->assertFalse($player->equals($otherPlayer));
    }
}
