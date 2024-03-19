<?php

namespace Domain;


use Domain\Exception\PlayerIsNotMemberOfGameException;
use Domain\Question\AnswerId;
use Domain\Question\Category;
use Domain\Question\QuestionId;
use Domain\State\Base\StateMachine;
use Domain\State\InvitedUserChoosingCategoryState;
use Domain\ValueObjects\GameId;
use Domain\ValueObjects\PlayerId;

final class Game
{

    public array $events = [];

    public function __construct(
        public GameId       $id,
        public PlayerId     $invitingPlayer,
        public PlayerId     $invitedPlayer,
        public array        $rounds,
        public StateMachine $stateMachine,
    )
    {
    }

    public static function invite(PlayerId $invitingPlayer, PlayerId $invitedPlayer): self
    {
        return new self(
            GameId::make(),
            $invitingPlayer,
            $invitedPlayer,
            [],
            StateMachine::initialize(),
        );
    }

    public function acceptInvitation(PlayerId $acceptingPlayer): void
    {
        $this->stateMachine->transitionTo(InvitedUserChoosingCategoryState::class);
    }

    public function chooseCategory(PlayerId $choosingPlayer, Category $category, QuestionId $questionId): void
    {

    }

    public function answerQuestion(PlayerId $answeringPlayer, QuestionId $questionId, AnswerId $answerId): void
    {

    }

    private function checkIfPlayerIsMember(PlayerId $playerId): void
    {
        if ($this->invitingPlayer->equals($playerId) || $this->invitedPlayer->equals($playerId)) {
            return;
        }

        throw new PlayerIsNotMemberOfGameException($playerId, $this->id);
    }


}
