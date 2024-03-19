<?php

namespace Domain\State;

use Domain\State\Base\BaseGameState;

final class InvitedPlayerChoosingCategoryState extends BaseGameState
{

    protected function allowsTransitionsTo(): array
    {
        return [
            InvitedPlayerAnsweringQuestionState::class,
        ];
    }
}
