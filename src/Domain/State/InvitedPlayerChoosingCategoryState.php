<?php

namespace Core\Domain\State;

use Core\Domain\State\Base\BaseGameState;

final class InvitedPlayerChoosingCategoryState extends BaseGameState
{
    protected function allowsTransitionsTo(): array
    {
        return [
            InvitedPlayerAnsweringQuestionState::class,
        ];
    }
}
