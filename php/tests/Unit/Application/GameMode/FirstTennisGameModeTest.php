<?php

declare(strict_types=1);

namespace Tests\Unit\Application\GameMode;

use TennisGame\Application\GameMode\FirstGameMode;
use TennisGame\Domain\Model\MatchScore;

class FirstTennisGameModeTest extends GameModeTester
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->gameMode = new FirstGameMode();
    }

    /**
     * @dataProvider provideScoreSampleData
     */
    public function testScores(int $firstScoreValue, int $secondScoreValue, string $expectedResult): void
    {
        // Arrange
        $scoreForFirstPlayer = new MatchScore($firstScoreValue);
        $scoreForSecondPlayer = new MatchScore($secondScoreValue);

        // Act
        $gameScoreMessage = $this->gameMode->prepareMessageFromMatchPoints($scoreForFirstPlayer, $scoreForSecondPlayer);

        // Assert
        self::assertSame($expectedResult, $gameScoreMessage);
    }
}
