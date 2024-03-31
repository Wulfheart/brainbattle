<?php

namespace Tests\Unit\Core\Domain\Round;

use Core\Domain\Question\Answer;
use Core\Domain\Question\AnswerCollection;
use Core\Domain\Question\AnswerId;
use Core\Domain\Question\Category;
use Core\Domain\Question\CategoryId;
use Core\Domain\Question\Question;
use Core\Domain\Question\QuestionCollection;
use Core\Domain\Question\QuestionId;
use Core\Domain\Round\Round;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Round::class)]
class RoundTest extends TestCase
{
    public function test_start(): void
    {
        $questionCollection = new QuestionCollection([
            $this->createQuestion(false, false),
            $this->createQuestion(false, false),
            $this->createQuestion(false, false),
        ]);

        $category = new Category(CategoryId::make(), 'CATEGORY_NAME');

        $round = Round::start($category, $questionCollection);

        $this->assertSame($category, $round->category);
        $this->assertSame($questionCollection, $round->questionCollection);
    }

    public function test_hasBeenFinishedByInvitingPlayer_returns_true(): void
    {
        $questionCollection = new QuestionCollection([
            $this->createQuestion(true, false),
            $this->createQuestion(true, false),
            $this->createQuestion(true, false),
        ]);

        $category = new Category(CategoryId::make(), 'CATEGORY_NAME');

        $round = Round::start($category, $questionCollection);

        $this->assertTrue($round->hasBeenFinishedByInvitingPlayer());
    }

    public function test_hasBeenFinishedByInvitingPlayer_returns_false(): void
    {
        $questionCollection = new QuestionCollection([
            $this->createQuestion(true, false),
            $this->createQuestion(true, false),
            $this->createQuestion(false, false),
        ]);

        $category = new Category(CategoryId::make(), 'CATEGORY_NAME');

        $round = Round::start($category, $questionCollection);

        $this->assertFalse($round->hasBeenFinishedByInvitingPlayer());
    }

    public function test_hasBeenFinishedByInvitedPlayer_returns_true(): void
    {
        $questionCollection = new QuestionCollection([
            $this->createQuestion(true, true),
            $this->createQuestion(true, true),
            $this->createQuestion(true, true),
        ]);

        $category = new Category(CategoryId::make(), 'CATEGORY_NAME');

        $round = Round::start($category, $questionCollection);

        $this->assertTrue($round->hasBeenFinishedByInvitedPlayer());
    }

    public function test_hasBeenFinishedByInvitedPlayer_returns_false(): void
    {
        $questionCollection = new QuestionCollection([
            $this->createQuestion(true, true),
            $this->createQuestion(true, true),
            $this->createQuestion(false, false),
        ]);

        $category = new Category(CategoryId::make(), 'CATEGORY_NAME');

        $round = Round::start($category, $questionCollection);

        $this->assertFalse($round->hasBeenFinishedByInvitedPlayer());
    }

    public function test_answerQuestionForInvitingPlayer_can_be_done(): void
    {
        $question = $this->createQuestion(false, false);
        $questionCollection = new QuestionCollection([
            $question,
        ]);

        $category = new Category(CategoryId::make(), 'CATEGORY_NAME');

        $round = Round::start($category, $questionCollection);

        $round->answerQuestionForInvitingPlayer($question->id, $question->answerCollection->first()->id);

        $this->assertTrue($question->hasBeenFinishedByInvitingPlayer());
    }
    public function test_answerQuestionForInvitedPlayer_can_be_done(): void
    {
        $question = $this->createQuestion(false, false);
        $questionCollection = new QuestionCollection([
            $question,
        ]);

        $category = new Category(CategoryId::make(), 'CATEGORY_NAME');

        $round = Round::start($category, $questionCollection);

        $round->answerQuestionForInvitedPlayer($question->id, $question->answerCollection->first()->id);

        $this->assertTrue($question->hasBeenFinishedByInvitedPlayer());
    }

    private function createQuestion(bool $answeredByInvitingPlayer, bool $answeredByInvitedPlayer, ?QuestionId $questionId = null): Question
    {
        $answerCollection = new AnswerCollection([
            new Answer(
                AnswerId::make(),
                'ANSWER_1',
                false,
                $answeredByInvitingPlayer,
                $answeredByInvitedPlayer
            ),
        ]);

        return new Question($questionId ?? QuestionId::make(), 'QUESTION_TEXT', $answerCollection);
    }
}
