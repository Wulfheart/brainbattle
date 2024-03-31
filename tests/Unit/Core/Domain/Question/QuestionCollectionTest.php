<?php

namespace Tests\Unit\Core\Domain\Question;

use Core\Domain\Exception\TryingToAnswerQuestionThatIsNotTheLatestException;
use Core\Domain\Question\Answer;
use Core\Domain\Question\AnswerCollection;
use Core\Domain\Question\AnswerId;
use Core\Domain\Question\Question;
use Core\Domain\Question\QuestionCollection;
use Core\Domain\Question\QuestionId;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(QuestionCollection::class)]
class QuestionCollectionTest extends TestCase
{
    public function test_hasBeenFinishedByInvitingPlayer_returns_true()
    {
        $questionCollection = new QuestionCollection([
            $this->createQuestion(true, false),
            $this->createQuestion(true, false),
            $this->createQuestion(true, false),
        ]);

        $this->assertTrue($questionCollection->hasBeenFinishedByInvitingPlayer());
    }

    public function test_hasBeenFinishedByInvitingPlayer_returns_false()
    {
        $questionCollection = new QuestionCollection([
            $this->createQuestion(true, false),
            $this->createQuestion(false, false),
            $this->createQuestion(false, false),
        ]);

        $this->assertFalse($questionCollection->hasBeenFinishedByInvitingPlayer());
    }

    public function test_hasBeenFinishedByInvitedPlayer_returns_true()
    {
        $questionCollection = new QuestionCollection([
            $this->createQuestion(false, true),
            $this->createQuestion(false, true),
            $this->createQuestion(false, true),
        ]);

        $this->assertTrue($questionCollection->hasBeenFinishedByInvitedPlayer());
    }

    public function test_hasBeenFinishedByInvitedPlayer_returns_false()
    {
        $questionCollection = new QuestionCollection([
            $this->createQuestion(true, true),
            $this->createQuestion(false, false),
            $this->createQuestion(false, false),
        ]);

        $this->assertFalse($questionCollection->hasBeenFinishedByInvitedPlayer());
    }

    public function test_answerQuestionForInvitingPlayer_throws_exception_if_trying_to_answer_question_that_is_not_the_latest(): void
    {
        $questionId = QuestionId::make();
        $questionCollection = new QuestionCollection([
            $this->createQuestion(false, false),
            $this->createQuestion(false, false, $questionId),
            $this->createQuestion(false, false),
        ]);

        $this->expectException(TryingToAnswerQuestionThatIsNotTheLatestException::class);
        $this->expectExceptionCode(TryingToAnswerQuestionThatIsNotTheLatestException::REASON_INVITING_PLAYER);
        $questionCollection->answerQuestionForInvitingPlayer($questionId, AnswerId::make());
    }

    public function test_answerQuestionForInvitingPlayer_can_answer(): void
    {
        $question = $this->createQuestion(false, false);

        $questionCollection = new QuestionCollection([
            $question,
            $this->createQuestion(false, false),
            $this->createQuestion(false, false),
        ]);

        $questionCollection->answerQuestionForInvitingPlayer(
            $question->id,
            $question->answerCollection->getAnswersInRandomOrder()[0]->id
        );

        $this->assertTrue($question->hasBeenFinishedByInvitingPlayer());
    }

    public function test_answerQuestionForInvitedPlayer_throws_exception_if_trying_to_answer_question_that_is_not_the_latest(): void
    {
        $questionId = QuestionId::make();
        $questionCollection = new QuestionCollection([
            $this->createQuestion(false, false),
            $this->createQuestion(false, false, $questionId),
            $this->createQuestion(false, false),
        ]);

        $this->expectException(TryingToAnswerQuestionThatIsNotTheLatestException::class);
        $this->expectExceptionCode(TryingToAnswerQuestionThatIsNotTheLatestException::REASON_INVITED_PLAYER);
        $questionCollection->answerQuestionForInvitedPlayer($questionId, AnswerId::make());
    }

    public function test_answerQuestionForInvitedPlayer_can_answer(): void
    {
        $question = $this->createQuestion(false, false);

        $questionCollection = new QuestionCollection([
            $question,
            $this->createQuestion(false, false),
            $this->createQuestion(false, false),
        ]);

        $questionCollection->answerQuestionForInvitedPlayer(
            $question->id,
            $question->answerCollection->getAnswersInRandomOrder()[0]->id
        );

        $this->assertTrue($question->hasBeenFinishedByInvitedPlayer());
    }

    private function createQuestion(bool $answeredByInvitingPlayer, bool $answeredByInvitedPlayer, ?QuestionId $questionId = null): Question
    {
        $answerCollection = new AnswerCollection([
            new Answer(AnswerId::make(), 'ANSWER_1', false, $answeredByInvitingPlayer, $answeredByInvitedPlayer),
        ]);

        return new Question($questionId ?? QuestionId::make(), 'QUESTION_TEXT', $answerCollection);
    }
}
