<?php

declare(strict_types=1);

namespace Tests\Unit\Application\GameMode;

use TennisGame\Application\AggregateRoot\TennisGameNumberThree;

class ThirdTennisGameModeTest extends GameModeTester
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->game = new TennisGameNumberThree('player1', 'player2');
    }

    /**
     * @dataProvider provideScoreSampleData
     */
    public function testScores(int $score1, int $score2, string $expectedResult): void
    {
        $this->seedScores($score1, $score2);
        $this->assertSame($expectedResult, $this->game->getMatchScoreDescription());
    }
}
