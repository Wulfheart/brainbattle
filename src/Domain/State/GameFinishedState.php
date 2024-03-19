<?php

namespace Core\Domain\State;

use Core\Domain\State\Base\BaseGameState;

final class GameFinishedState extends BaseGameState
{
    protected function allowsTransitionsTo(): array
    {
        return [];
    }
}
