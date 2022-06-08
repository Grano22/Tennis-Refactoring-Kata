<?php

declare(strict_types=1);

namespace Tests\Unit\Application\AggregateRoot;

use TennisGame\Application\AggregateRoot\TennisGame2;

/**
 * TennisGameNumberOne test case.
 */
class TennisGame2Test extends TestMaster
{
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->game = new TennisGame2('player1', 'player2');
    }

    /**
     * @dataProvider data
     */
    public function testScores(int $score1, int $score2, string $expectedResult): void
    {
        $this->seedScores($score1, $score2);
        $this->assertSame($expectedResult, $this->game->getMatchScoreDescription());
    }
}
