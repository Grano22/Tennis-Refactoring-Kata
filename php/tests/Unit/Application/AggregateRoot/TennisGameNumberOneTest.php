<?php

declare(strict_types=1);

namespace Tests\Unit\Application\AggregateRoot;

use TennisGame\Domain\Exception\PlayerNickIsAlreadyTaken;
use Tests\Kit\GameApplication;

class TennisGameNumberOneTest extends TestMaster
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->gameApplication = new GameApplication();
    }

    public function testAllDuplicatedPlayerNickWillBeDetected(): void
    {
        // Arrange
        $duplicatedNick = 'myAwesomeNick';

        // Assert
        self::expectExceptionObject(PlayerNickIsAlreadyTaken::forGivenNick($duplicatedNick));

        // Act
        $this->gameApplication->createTennisGameNumberOne($duplicatedNick, $duplicatedNick);
    }

    public function testAllPlayersSavedSuccessfully(): void
    {
        // Arrange && Act
        $this->gameApplication->createTennisGameNumberOne('player1', 'player2');

        // Assert
        self::assertCount(2, $this->gameApplication->playersRepository->findAll());
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
        $this->assertSame($expectedResult, $game->getMatchScoreDescription());
    }
}
