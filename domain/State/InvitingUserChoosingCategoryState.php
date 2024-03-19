<?php

namespace Domain\State;

use Domain\State\Base\BaseGameState;

final class InvitingUserChoosingCategoryState extends Base\BaseGameState
{
    protected function allowsTransitionsTo(): array
    {
        return [
          InvitingUserAnsweringQuestionState::class,
        ];
    }
}
