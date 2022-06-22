<?php

declare(strict_types=1);


namespace Tests\Unit;

use PHPStan\Testing\TestCase;
use TennisGame\Application\Exception\GameIsNotConfigured;
use TennisGame\Application\GameMode\FirstGameMode;
use Tests\Kit\TestGameApplication;

final class TennisGameApplicationTest extends TestCase
{
    private TestGameApplication $gameApplication;

    protected function setUp(): void
    {
        $this->gameApplication = new TestGameApplication();
    }

    public function testGameWillGenerateSuccessfulMatchSummaryMessage(): void
    {
        // Arrange
        $firstPlayerNick = 'firstPlayerNick';
        $secondPlayerNick = 'secondPlayerNick';
        $this->gameApplication->getGameApplication()->setupGame(
            FirstGameMode::class,
            $firstPlayerNick,
            $secondPlayerNick
        );
        $this->gameApplication->getGameApplication()->wonPoint($firstPlayerNick);
        $this->gameApplication->getGameApplication()->wonPoint($secondPlayerNick);

        // Act
        $matchScoreSummary = $this->gameApplication->getGameApplication()->getScoreSummary();

        // Assert
        self::assertSame('Fifteen-All', $matchScoreSummary);
    }

    public function testGameCannotBeStartedWithoutConfiguration(): void
    {
        // Arrange

        // Assert
        self::expectExceptionObject(GameIsNotConfigured::create());

        // Act
        $this->gameApplication->getGameApplication()->getScoreSummary();
    }
}
