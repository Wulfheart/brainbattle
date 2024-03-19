<?php

namespace Tests\Unit\Core\Domain\Question;

use Core\Domain\Question\Answer;
use Core\Domain\Question\AnswerCollection;
use Core\Domain\Question\AnswerId;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(AnswerCollection::class)]
class AnswerCollectionTest extends TestCase
{
    public function test_getAnswersInRandomOrder_does_not_randomize_the_order(): void
    {
        $answer1 = new Answer(AnswerId::make(), 'ANSWER_1', false, false, false);
        $answer2 = new Answer(AnswerId::make(), 'ANSWER_2', false, false, false);
        $answer3 = new Answer(AnswerId::make(), 'ANSWER_3', false, false, false);
        $answer4 = new Answer(AnswerId::make(), 'ANSWER_4', false, false, false);

        $answers = new AnswerCollection([$answer1, $answer2, $answer3, $answer4]);

        $notEquals = false;
        for ($i = 0; $i < 10; $i++) {
            if ($answers->getAnswersInRandomOrder() !== $answers->getAnswersInRandomOrder()) {
                $notEquals = true;
                break;
            }
        }

        $this->assertTrue($notEquals);
    }

    public function test_hasASelectedAnswerFromInvitingPlayer(): void
    {
        $answer1 = new Answer(AnswerId::make(), 'ANSWER_1', false, false, false);
        $answerWithSelection = new Answer(AnswerId::make(), 'ANSWER_2', false, true, false);
        $answerWithoutSelection = new Answer(AnswerId::make(), 'ANSWER_3', false, false, false);

        $answersWithSelection = new AnswerCollection([$answer1, $answerWithSelection, $answerWithoutSelection]);
        $this->assertTrue($answersWithSelection->hasASelectedAnswerFromInvitingPlayer());

        $answersWithoutSelection = new AnswerCollection([$answer1, $answerWithoutSelection]);
        $this->assertFalse($answersWithoutSelection->hasASelectedAnswerFromInvitingPlayer());
    }

    public function test_hasASelectedAnswerFromInvitedPlayer(): void
    {
        $answer1 = new Answer(AnswerId::make(), 'ANSWER_1', false, false, false);
        $answerWithSelection = new Answer(AnswerId::make(), 'ANSWER_2', false, true, true);
        $answerWithoutSelection = new Answer(AnswerId::make(), 'ANSWER_3', false, false, false);

        $answersWithSelection = new AnswerCollection([$answer1, $answerWithSelection, $answerWithoutSelection]);
        $this->assertTrue($answersWithSelection->hasASelectedAnswerFromInvitedPlayer());

        $answersWithoutSelection = new AnswerCollection([$answer1, $answerWithoutSelection]);
        $this->assertFalse($answersWithoutSelection->hasASelectedAnswerFromInvitedPlayer());
    }

    public function test_getAnswerById_throws_exception_if_answerId_is_not_found(): void
    {
        $answerId = AnswerId::make();
        $answer1 = new Answer(AnswerId::make(), 'ANSWER_1', false, false, false);

        $answers = new AnswerCollection([$answer1]);

        $this->expectException(\InvalidArgumentException::class);
        $answers->answerForInvitingPlayer($answerId);
    }

    public function test_getAnswerById_returns_the_answer(): void
    {
        $answerId = AnswerId::make();
        $answer1 = new Answer($answerId, 'ANSWER_1', false, false, false);
        $answer2 = new Answer(AnswerId::make(), 'ANSWER_2', false, false, false);

        $answers = new AnswerCollection([$answer1, $answer2]);
        $this->assertSame($answer1, $answers->getAnswerById($answerId));
    }

    public function test_answerForInvitingPlayer_selects_the_answer(): void
    {
        $answerId = AnswerId::make();
        $answer1 = new Answer($answerId, 'ANSWER_1', false, false, false);
        $answer2 = new Answer(AnswerId::make(), 'ANSWER_2', false, false, false);

        $answers = new AnswerCollection([$answer1, $answer2]);
        $answers->answerForInvitingPlayer($answerId);

        $this->assertTrue($answers->getAnswerById($answerId)->isSelectedByInvitingPlayer);
    }

    public function test_answerForInvitedPlayer_selects_the_answer(): void
    {
        $answerId = AnswerId::make();
        $answer1 = new Answer($answerId, 'ANSWER_1', false, false, false);
        $answer2 = new Answer(AnswerId::make(), 'ANSWER_2', false, false, false);

        $answers = new AnswerCollection([$answer1, $answer2]);
        $answers->answerForInvitedPlayer($answerId);

        $this->assertTrue($answers->getAnswerById($answerId)->isSelectedByInvitedPlayer);
    }
}
