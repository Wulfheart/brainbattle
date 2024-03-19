<?php

namespace Domain\State;

use Domain\State\Base\BaseGameState;

final class InvitationSentState extends BaseGameState
{
    protected function allowsTransitionsTo(): array
    {
        return [
            InvitedUserChoosingCategoryState::class,
        ];
    }
}
