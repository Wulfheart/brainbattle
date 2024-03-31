<?php

namespace Core\Domain\State\States;

use Core\Domain\State\BaseGameState;

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
