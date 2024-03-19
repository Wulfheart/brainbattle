<?php

namespace Domain\State;

use Domain\State\Base\BaseGameState;

final class InvitingUserAnsweringQuestionState extends BaseGameState
{

    protected function allowsTransitionsTo(): array
    {
        return [
            GameFinishedState::class,
            InvitingUserChoosingCategoryState::class,
            InvitedUserAnsweringQuestionState::class,
        ];
    }
}
