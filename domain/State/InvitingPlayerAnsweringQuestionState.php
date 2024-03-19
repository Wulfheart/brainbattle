<?php

namespace Domain\State;

use Domain\State\Base\BaseGameState;

final class InvitingPlayerAnsweringQuestionState extends BaseGameState
{
    protected function allowsTransitionsTo(): array
    {
        return [
            GameFinishedState::class,
            InvitingPlayerChoosingCategoryState::class,
            InvitedPlayerAnsweringQuestionState::class,
        ];
    }
}
