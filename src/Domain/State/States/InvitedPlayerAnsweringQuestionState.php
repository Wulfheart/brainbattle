<?php

namespace Core\Domain\State\States;

use Core\Domain\State\BaseGameState;

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
