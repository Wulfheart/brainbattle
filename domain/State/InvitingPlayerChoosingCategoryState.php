<?php

namespace Domain\State;

use Domain\State\Base\BaseGameState;

final class InvitingPlayerChoosingCategoryState extends BaseGameState
{
    protected function allowsTransitionsTo(): array
    {
        return [
            InvitingPlayerAnsweringQuestionState::class,
        ];
    }
}
