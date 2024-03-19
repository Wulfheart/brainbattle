<?php

namespace Domain\State\Base;

abstract class BaseGameState
{
    /**
     * @return array<class-string<BaseGameState>>
     */
    abstract protected function allowsTransitionsTo(): array;

    /**
     * @param  class-string<BaseGameState>  $state
     */
    public function allowsTransitionTo(string $state): bool
    {
        return in_array($state, $this->allowsTransitionsTo());
    }
}
