<?php

declare(strict_types=1);

namespace Tests;

use TennisGame\Domain\Exception\PlayerNickIsAlreadyTaken;
use TennisGame\Domain\Policy\PlayerRegistrationPolicy;
use TennisGame\TennisGame1;
use Tests\Kit\GameApplication;

class TennisGame1Test extends TestMaster
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->gameApplication = new GameApplication();
    }

    public function testAllRegisteredUserNicksMustBeUnique(): void
    {
        // Arrange
        $duplicatedNick = 'myAwesomeNick';

        // Assert
        self::expectExceptionObject(PlayerNickIsAlreadyTaken::forGivenNick($duplicatedNick));

        // Act
        $this->gameApplication->createTennisGameNumberOne($duplicatedNick, $duplicatedNick);
    }

    /**
     * @dataProvider data
     */
    public function testScores(int $score1, int $score2, string $expectedResult): void
    {
        // Arrange
        $game = $this->gameApplication->createTennisGameNumberOne('player1', 'player2');

        // Act
        $this->seedScores($game, $score1, $score2);

        // Assert
        $this->assertSame($expectedResult, $game->getScore());
    }
}
