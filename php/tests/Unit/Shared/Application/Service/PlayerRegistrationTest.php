<?php

declare(strict_types=1);


namespace Tests\Unit\Shared\Application\Service;

use PHPStan\Testing\TestCase;
use TennisGame\Application\Repository\InMemoryPlayerRepository;
use TennisGame\Application\Repository\PlayerRepository;
use TennisGame\Application\Service\PlayerRegistration;
use TennisGame\Domain\Entity\Player;
use TennisGame\Domain\Exception\PlayerNickIsAlreadyTaken;
use TennisGame\Domain\Policy\PlayerRegistrationPolicy;

final class PlayerRegistrationTest extends TestCase
{
    private PlayerRepository $playersRepository;
    private PlayerRegistration $playerRegistrationService;

    protected function setUp(): void
    {
        $this->playersRepository = new InMemoryPlayerRepository();
        $this->playerRegistrationService =
            new PlayerRegistration(
                new PlayerRegistrationPolicy($this->playersRepository),
                $this->playersRepository
            );
    }

    public function testAllPlayersSavedSuccessfully(): void
    {
        // Arrange

        // Act
        $this->playerRegistrationService->registerPlayers(new Player('player1'), new Player('player2'));

        // Assert
        self::assertCount(2, $this->playersRepository->findAll());
    }

    public function testAllDuplicatedPlayerNickWillBeDetectedDuringRegistration(): void
    {
        // Arrange
        $duplicatedNick = 'myAwesomeNick';

        // Assert
        self::expectExceptionObject(PlayerNickIsAlreadyTaken::forGivenNick($duplicatedNick));

        // Act
        $this->playerRegistrationService->registerPlayers(new Player($duplicatedNick), new Player($duplicatedNick));
    }

    public function testAllPlayersWillBeUnregisteredSuccessfully(): void
    {
        // Arrange
        $playerOne = new Player('firstNick');
        $playerTwo = new Player('secondNick');
        $playerThree = new Player('thirdNick');
        $this->playerRegistrationService->registerPlayers($playerOne, $playerTwo, $playerThree);

        // Act
        $this->playerRegistrationService->unregisterAll();

        // Assert
        self::assertCount(0, $this->playersRepository->findAll());
    }
}
