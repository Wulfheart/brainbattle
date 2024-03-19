<?php

namespace Core\Domain\State;

use Core\Domain\State\Base\BaseGameState;

final class InvitingPlayerChoosingCategoryState extends BaseGameState
{
    protected function allowsTransitionsTo(): array
    {
        return [
            InvitingPlayerAnsweringQuestionState::class,
        ];
    }
}
