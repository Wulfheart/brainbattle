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

    /**
     * @param class-string<BaseGameState> $state
     */
    public function transitionTo(string $state): void
    {
        if ($this->allowsTransitionTo($state)) {
            $this->state = new $state();
        } else {
            throw new InvalidStateTransitionException(
                fromState: get_class($this->state),
                toState: $state
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

    /**
     * @param class-string<BaseGameState> $state
     */
    public function hasCurrentState(string $state): bool
    {
        return $this->state instanceof $state;
    }
}
