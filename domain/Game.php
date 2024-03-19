<?php

namespace Domain;


use Domain\Question\AnswerId;
use Domain\Question\Category;
use Domain\Question\QuestionId;
use Domain\ValueObjects\GameId;
use Domain\ValueObjects\PlayerId;

final class Game
{

    public array $events = [];

    public function __construct(
        public GameId $id,
        public PlayerId $invitingPlayer,
        public PlayerId $invitedPlayer,
        public array $rounds,
    )
    {
    }

    public static function invite(PlayerId $invitingPlayer, PlayerId $invitedPlayer): self
    {
        return new self(
            GameId::make(),
            $invitingPlayer,
            $invitedPlayer,
            []
        );
    }

    public function acceptInvitation(PlayerId $acceptingPlayer): void
    {

    }

    public function chooseCategory(PlayerId $choosingPlayer, Category $category, QuestionId $questionId): void
    {

    }

    public function answerQuestion(PlayerId $answeringPlayer, QuestionId $questionId, AnswerId $answerId): void
    {

    }


}
