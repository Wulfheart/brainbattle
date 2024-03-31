<?php

namespace Core\Domain\State\States;

use Core\Domain\State\BaseGameState;

final class GameFinishedState extends BaseGameState
{
    protected function allowsTransitionsTo(): array
    {
        return [];
    }
}
