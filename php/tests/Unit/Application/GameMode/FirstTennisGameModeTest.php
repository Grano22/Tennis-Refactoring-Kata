<?php

declare(strict_types=1);

namespace Tests\Unit\Application\GameMode;

use TennisGame\Application\GameMode\FirstGameMode;

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
    public function testScores(int $score1, int $score2, string $expectedResult): void
    {
        // Arrange

        // Act
        $gameScoreMessage = $this->gameMode->prepareMessageFromMatchPoints($score1, $score2);

        // Assert
        self::assertSame($expectedResult, $gameScoreMessage);
    }
}
