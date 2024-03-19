<?php

namespace Tests\Unit\Core\Domain\Question;

use Core\Domain\Question\Answer;
use Core\Domain\Question\AnswerId;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Answer::class)]
class AnswerTest extends TestCase
{
    public function test_constructor()
    {
        $answerId = AnswerId::make();
        $answerText = '::ANSWER_TEXT::';
        $answer = new Answer($answerId, $answerText, false, true, false);

        $this->assertSame($answerId, $answer->id);
        $this->assertEquals($answerText, $answer->answerText);
        $this->assertFalse($answer->isCorrect);
        $this->assertTrue($answer->isSelectedByInvitingPlayer);
        $this->assertFalse($answer->isSelectedByInvitedPlayer);
    }
}
