<?php

namespace Core\Domain\State;

use Core\Domain\State\Base\BaseGameState;

final class InvitationSentState extends BaseGameState
{
    protected function allowsTransitionsTo(): array
    {
        return [
            InvitedPlayerChoosingCategoryState::class,
        ];
    }
}
