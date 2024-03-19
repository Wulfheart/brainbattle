<?php

namespace Domain\State;

use Domain\State\Base\BaseGameState;

final class GameFinishedState extends BaseGameState
{

    protected function allowsTransitionsTo(): array
    {
        return [];
    }
}
