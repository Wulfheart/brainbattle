<?php

namespace Core\Domain\State\States;

use Core\Domain\State\BaseGameState;

final class InvitedPlayerChoosingCategoryState extends BaseGameState
{
    protected function allowsTransitionsTo(): array
    {
        return [
            InvitedPlayerAnsweringQuestionState::class,
        ];
    }
}
