<?php

namespace Domain;

use Domain\Event\GameFinishedEvent;
use Domain\Event\TurnFinishedEvent;
use Domain\Exception\PlayerIsNotInvitedPlayerException;
use Domain\Exception\PlayerIsNotInvitingPlayerException;
use Domain\Exception\PlayerIsNotMemberOfGameException;
use Domain\Player\Player;
use Domain\Player\PlayerTypeEnum;
use Domain\Question\AnswerId;
use Domain\Question\Category;
use Domain\Question\QuestionCollection;
use Domain\Question\QuestionId;
use Domain\Round\Round;
use Domain\State\Base\StateMachine;
use Domain\State\GameFinishedState;
use Domain\State\InvitedPlayerAnsweringQuestionState;
use Domain\State\InvitedPlayerChoosingCategoryState;
use Domain\State\InvitingPlayerAnsweringQuestionState;
use Domain\State\InvitingPlayerChoosingCategoryState;
use Domain\ValueObjects\GameId;

final class Game
{
    public const int MAX_ROUNDS = 6;

    private array $events = [];

    public function __construct(
        public GameId $id,
        public Player $invitingPlayer,
        public Player $invitedPlayer,
        public array $rounds,
        public StateMachine $stateMachine,
    ) {
    }

    public static function invite(Player $invitingPlayer, Player $invitedPlayer): self
    {
        return new self(
            GameId::make(),
            $invitingPlayer,
            $invitedPlayer,
            [],
            StateMachine::initialize(),
        );
    }

    public function acceptInvitation(Player $acceptingPlayer): void
    {
        $this->checkIfPlayerIsMember($acceptingPlayer);
        $this->stateMachine->transitionTo(InvitedPlayerChoosingCategoryState::class);
    }

    public function chooseCategory(Player $choosingPlayer, Category $category, QuestionCollection $questionCollection): void
    {
        $this->checkIfPlayerIsMember($choosingPlayer);
        if ($this->stateMachine->hasCurrentState(InvitedPlayerChoosingCategoryState::class)) {
            if ($choosingPlayer->type !== PlayerTypeEnum::INVITED) {
                throw new PlayerIsNotInvitingPlayerException($choosingPlayer->id, $this->id);
            }

            $this->stateMachine->transitionTo(InvitedPlayerAnsweringQuestionState::class);
        } else {
            if ($this->invitingPlayer->type !== PlayerTypeEnum::INVITING) {
                throw new PlayerIsNotInvitingPlayerException($choosingPlayer->id, $this->id);
            }

            $this->stateMachine->transitionTo(InvitingPlayerAnsweringQuestionState::class);
        }

        $this->rounds[] = Round::start($category, $questionCollection);
    }

    public function answerQuestionForInvitedPlayer(Player $answeringPlayer, QuestionId $questionId, AnswerId $answerId): void
    {
        $this->checkIfPlayerIsMember($answeringPlayer);

        $currentRound = $this->getLatestRound();

        if ($answeringPlayer->type !== PlayerTypeEnum::INVITED) {
            throw new PlayerIsNotInvitedPlayerException($answeringPlayer->id, $this->id);
        }

        $currentRound->answerQuestionForInvitedPlayer($questionId, $answerId);

        if ($currentRound->hasBeenFinishedByInvitedPlayer()) {
            if ($currentRound->hasBeenFinishedByInvitingPlayer()) {
                $this->stateMachine->transitionTo(InvitedPlayerChoosingCategoryState::class);
            } else {
                $this->stateMachine->transitionTo(InvitingPlayerAnsweringQuestionState::class);
                $this->addEvent(new TurnFinishedEvent($this->id, $answeringPlayer->type));
            }
        }
    }

    public function answerQuestionForInvitingPlayer(Player $answeringPlayer, QuestionId $questionId, AnswerId $answerId): void
    {
        $this->checkIfPlayerIsMember($answeringPlayer);

        $currentRound = $this->getLatestRound();

        if ($answeringPlayer->type !== PlayerTypeEnum::INVITING) {
            throw new PlayerIsNotInvitingPlayerException($answeringPlayer->id, $this->id);
        }

        $currentRound->answerQuestionForInvitingPlayer($questionId, $answerId);

        if (count($this->rounds) >= self::MAX_ROUNDS && $currentRound->hasBeenFinishedByInvitingPlayer()) {
            $this->stateMachine->transitionTo(GameFinishedState::class);
            $this->addEvent(new GameFinishedEvent($this->id));
        }
        if ($currentRound->hasBeenFinishedByInvitingPlayer()) {
            if ($currentRound->hasBeenFinishedByInvitedPlayer()) {
                $this->stateMachine->transitionTo(InvitingPlayerChoosingCategoryState::class);
            } else {
                $this->stateMachine->transitionTo(InvitedPlayerAnsweringQuestionState::class);
                $this->addEvent(new TurnFinishedEvent($this->id, $answeringPlayer->type));
            }
        }
    }

    public function getLatestRound(): Round
    {
        $roundCount = count($this->rounds);
        if ($roundCount === 0) {
            throw new \Exception('No rounds in game');
        }

        return $this->rounds[$roundCount - 1];
    }

    private function checkIfPlayerIsMember(Player $player): void
    {
        if ($this->invitingPlayer->equals($player) || $this->invitedPlayer->equals($player)) {
            return;
        }

        throw new PlayerIsNotMemberOfGameException($player->id, $this->id);
    }

    public function getEvents(): array
    {
        return $this->events;
    }

    public function addEvent(object $event): void
    {
        $this->events[] = $event;
    }

    public function flushEvents(): void
    {
        $this->events = [];
    }
}
