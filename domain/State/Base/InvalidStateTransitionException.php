<?php

namespace Domain\State\Base;

use Exception;

final class InvalidStateTransitionException extends Exception
{
    public function __construct(
        public string $fromState,
        public string $toState
    )
    {
        parent::__construct("Invalid state transition from $fromState to $toState");
    }
}
