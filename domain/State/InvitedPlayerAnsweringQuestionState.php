<?php

namespace Domain\State;

use Domain\State\Base\BaseGameState;

final class InvitedPlayerAnsweringQuestionState extends BaseGameState
{

    protected function allowsTransitionsTo(): array
    {
        return [
            InvitedPlayerChoosingCategoryState::class,
            InvitingPlayerAnsweringQuestionState::class,
        ];
    }
}
