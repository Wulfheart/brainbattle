<?php

namespace Tests\Unit\Core\Domain\State;

use Core\Domain\State\BaseGameState;
use Core\Domain\State\InvalidStateTransitionException;
use Core\Domain\State\StateMachine;
use Core\Domain\State\States\GameFinishedState;
use Core\Domain\State\States\InvitedPlayerChoosingCategoryState;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(StateMachine::class)]
#[CoversClass(BaseGameState::class)]
class StateMachineTest extends TestCase
{
    public function test_initialize(): void
    {
        $stateMachine = StateMachine::initialize();
        $this->assertTrue($stateMachine->hasCurrentState(BaseGameState::class));
    }

    public function test_transitionTo(): void
    {
        $stateMachine = StateMachine::initialize();
        $stateMachine->transitionTo(InvitedPlayerChoosingCategoryState::class);
        $this->assertTrue($stateMachine->hasCurrentState(InvitedPlayerChoosingCategoryState::class));
    }
    public function test_transitionTo_throws_exception_if_transition_is_not_possible(): void
    {
        $stateMachine = StateMachine::initialize();

        $this->expectException(InvalidStateTransitionException::class);
        $stateMachine->transitionTo(GameFinishedState::class);
    }
}
