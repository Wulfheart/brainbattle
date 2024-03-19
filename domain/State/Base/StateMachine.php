<?php

namespace Domain\State\Base;

use Domain\State\InvitationSentState;
use Faker\Provider\Base;

final class StateMachine
{
    public function __construct(
        private BaseGameState $state
    )
    {
    }

    public static function initialize(): self
    {
        return new self(new InvitationSentState());
    }

    public function transitionTo(BaseGameState $state): void
    {
        if ($this->allowsTransitionTo($state::class)) {
            $this->state = $state;
        } else {
            throw new InvalidStateTransitionException(
                fromState: get_class($this->state),
                toState: get_class($state)
            );
        }
    }

    /**
     * @param class-string<BaseGameState> $state
     * @return bool
     */
    public function allowsTransitionTo(string $state): bool
    {
        return $this->state->allowsTransitionTo($state);
    }
}
