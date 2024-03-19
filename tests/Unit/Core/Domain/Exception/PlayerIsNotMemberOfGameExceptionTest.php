<?php

namespace Tests\Unit\Core\Domain\Exception;

use Core\Domain\Exception\PlayerIsNotMemberOfGameException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(PlayerIsNotMemberOfGameException::class)]
class PlayerIsNotMemberOfGameExceptionTest extends TestCase
{
    public function test_message()
    {
        $exception = new PlayerIsNotMemberOfGameException('PLAYER_ID', 'GAME_ID');

        $this->assertSame('Player PLAYER_ID is not a member of game GAME_ID', $exception->getMessage());
    }
}
