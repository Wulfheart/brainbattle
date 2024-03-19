<?php

namespace Domain\State;

use Domain\State\Base\BaseGameState;

final class InvitedUserChoosingCategoryState extends BaseGameState
{

    protected function allowsTransitionsTo(): array
    {
        return [
            InvitedUserAnsweringQuestionState::class,
        ];
    }
}
