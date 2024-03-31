<?php

namespace Tests\Unit\Core\Domain\Question;

use Core\Domain\Exception\QuestionAlreadyAnsweredException;
use Core\Domain\Question\Answer;
use Core\Domain\Question\AnswerCollection;
use Core\Domain\Question\AnswerId;
use Core\Domain\Question\Question;
use Core\Domain\Question\QuestionId;
use Core\Domain\Question\QuestionTimeout;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Question::class)]
class QuestionTest extends TestCase
{
    public function test_hasBeenFinishedByInvitingPlayer_returns_true_due_to_selection(): void
    {
        $answerCollection = new AnswerCollection([
            new Answer(AnswerId::make(), '::ANSWER_TEXT::', false, true, false),
        ]);

        $question = new Question(
            QuestionId::make(),
            '::QUESTION_TEXT::',
            $answerCollection,
        );

        $this->assertTrue($question->hasBeenFinishedByInvitingPlayer());
    }

    public function test_hasBeenFinishedByInvitingPlayer_returns_true_due_to_timeout(): void
    {
        $question = new Question(
            QuestionId::make(),
            '::QUESTION_TEXT::',
            new AnswerCollection([]),
            new QuestionTimeout(new DateTimeImmutable('-1 minute'), new DateTimeImmutable()),
        );

        $this->assertTrue($question->hasBeenFinishedByInvitingPlayer());
    }

    public function test_hasBeenFinishedByInvitingPlayer_returns_false(): void
    {
        $question = new Question(
            QuestionId::make(),
            '::QUESTION_TEXT::',
            new AnswerCollection([]),
            new QuestionTimeout(new DateTimeImmutable('1 minute'), new DateTimeImmutable()),
        );

        $this->assertFalse($question->hasBeenFinishedByInvitingPlayer());
    }

    public function test_hasBeenFinishedByInvitedPlayer_returns_true_due_to_selection(): void
    {
        $answerCollection = new AnswerCollection([
            new Answer(AnswerId::make(), '::ANSWER_TEXT::', false, false, true),
        ]);

        $question = new Question(
            QuestionId::make(),
            '::QUESTION_TEXT::',
            $answerCollection,
        );

        $this->assertTrue($question->hasBeenFinishedByInvitedPlayer());
    }

    public function test_hasBeenFinishedByInvitedPlayer_returns_true_due_to_timeout(): void
    {
        $question = new Question(
            QuestionId::make(),
            '::QUESTION_TEXT::',
            new AnswerCollection([]),
            null,
            new QuestionTimeout(new DateTimeImmutable('-1 minute'), new DateTimeImmutable()),
        );

        $this->assertTrue($question->hasBeenFinishedByInvitedPlayer());
    }

    public function test_hasBeenFinishedByInvitedPlayer_returns_false(): void
    {
        $question = new Question(
            QuestionId::make(),
            '::QUESTION_TEXT::',
            new AnswerCollection([]),
            null,
            new QuestionTimeout(new DateTimeImmutable('1 minute'), new DateTimeImmutable()),
        );

        $this->assertFalse($question->hasBeenFinishedByInvitedPlayer());
    }

    public function test_answerForInvitingPlayer_throws_exception_if_it_has_already_been_answered(): void
    {
        $question = new Question(
            QuestionId::make(),
            '::QUESTION_TEXT::',
            new AnswerCollection([
                new Answer(AnswerId::make(), '::ANSWER_TEXT::', false, true, false),
            ]),
        );

        $this->expectException(QuestionAlreadyAnsweredException::class);
        $this->expectExceptionCode(QuestionAlreadyAnsweredException::REASON_INVITING_PLAYER);
        $question->answerForInvitingPlayer(AnswerId::make());
    }

    public function test_answerForInvitingPlayer_selects_the_answer(): void
    {
        $answer = new Answer(AnswerId::make(), '::ANSWER_TEXT::', false, false, false);
        $answerCollection = new AnswerCollection([
            $answer,
        ]);
        $question = new Question(
            QuestionId::make(),
            '::QUESTION_TEXT::',
            $answerCollection,
        );

        $question->answerForInvitingPlayer($answer->id);

        $this->assertTrue($answer->isSelectedByInvitingPlayer);
    }
    public function test_answerForInvitedPlayer_throws_exception_if_it_has_already_been_answered(): void
    {
        $question = new Question(
            QuestionId::make(),
            '::QUESTION_TEXT::',
            new AnswerCollection([
                new Answer(AnswerId::make(), '::ANSWER_TEXT::', false, false, true),
            ]),
        );

        $this->expectException(QuestionAlreadyAnsweredException::class);
        $this->expectExceptionCode(QuestionAlreadyAnsweredException::REASON_INVITED_PLAYER);
        $question->answerForInvitedPlayer(AnswerId::make());
    }

    public function test_answerForInvitedPlayer_selects_the_answer(): void
    {
        $answer = new Answer(AnswerId::make(), '::ANSWER_TEXT::', false, false, false);
        $answerCollection = new AnswerCollection([
            $answer,
        ]);
        $question = new Question(
            QuestionId::make(),
            '::QUESTION_TEXT::',
            $answerCollection,
        );

        $question->answerForInvitedPlayer($answer->id);

        $this->assertTrue($answer->isSelectedByInvitedPlayer);
    }
}
