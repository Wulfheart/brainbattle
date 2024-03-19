<?php

namespace Tests\Unit\Core\Domain\Exception;

use Core\Domain\Exception\PlayerIsNotInvitedPlayerException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(PlayerIsNotInvitedPlayerException::class)]
class PlayerIsNotInvitedPlayerExceptionTest extends TestCase
{
    public function test_message()
    {
        $exception = new PlayerIsNotInvitedPlayerException('PLAYER_ID', 'GAME_ID');

        $this->assertSame('Player PLAYER_ID is not the InvitedPlayer in game GAME_ID', $exception->getMessage());
    }
}
