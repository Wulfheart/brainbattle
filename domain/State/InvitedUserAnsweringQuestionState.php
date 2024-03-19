<?php

namespace Domain\State;

use Domain\State\Base\BaseGameState;

final class InvitedUserAnsweringQuestionState extends BaseGameState
{

    protected function allowsTransitionsTo(): array
    {
        return [
            InvitedUserChoosingCategoryState::class,
            InvitingUserAnsweringQuestionState::class,
        ];
    }
}
