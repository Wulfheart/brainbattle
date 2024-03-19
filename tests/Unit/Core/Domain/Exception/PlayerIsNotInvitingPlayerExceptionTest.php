<?php

namespace Tests\Unit\Core\Domain\Exception;

use Core\Domain\Exception\PlayerIsNotInvitingPlayerException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(PlayerIsNotInvitingPlayerException::class)]
class PlayerIsNotInvitingPlayerExceptionTest extends TestCase
{
    public function test_message(): void
    {
        $exception = new PlayerIsNotInvitingPlayerException('PLAYER_ID', 'GAME_ID');

        $this->assertSame('Player PLAYER_ID is not the InvitingPlayer in game GAME_ID', $exception->getMessage());
    }
}
