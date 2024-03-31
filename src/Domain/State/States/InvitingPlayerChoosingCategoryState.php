<?php

namespace Core\Domain\State\States;

use Core\Domain\State\BaseGameState;

final class InvitingPlayerChoosingCategoryState extends BaseGameState
{
    protected function allowsTransitionsTo(): array
    {
        return [
            InvitingPlayerAnsweringQuestionState::class,
        ];
    }
}
