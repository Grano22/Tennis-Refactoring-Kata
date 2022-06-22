<?php

declare(strict_types=1);

namespace TennisGame;

use TennisGame\Application\AggregateRoot\ScoreCollector;
use TennisGame\Application\Exception\GameIsNotConfigured;
use TennisGame\Application\Factory\GameModeFactory;
use TennisGame\Application\GameMode\GameMode;
use TennisGame\Application\Repository\PlayerRepository;
use TennisGame\Application\Service\PlayerRegistration;
use TennisGame\Domain\Entity\Player;

final class TennisGameApplication
{
    private GameMode $gameMode;

    public function __construct(
        private readonly PlayerRegistration $playerRegistration,
        private readonly PlayerRepository $playersRepository,
        private readonly ScoreCollector $scoreCollector,
        private readonly GameModeFactory $gameModeFactory
    ) {
    }

    public function setupGame(
        string $mode,
        string $firstPlayerNick,
        string $secondPlayerNick
    ): void  {
        $this->playerRegistration->unregisterAll();
        $this->gameMode = $this->gameModeFactory->create($mode);

        $this->playerRegistration->registerPlayers(new Player($firstPlayerNick), new Player($secondPlayerNick));
        $this->scoreCollector->initiateForPlayer($firstPlayerNick);
        $this->scoreCollector->initiateForPlayer($secondPlayerNick);
    }

    /**
     * @throws GameIsNotConfigured
     */
    public function getScoreSummary(): string
    {
        $this->checkIfGameIsConfigured();

        list($playerNumberOne, $playerNumberTwo) = $this->playersRepository->findAll()->toArray();

        $firstPlayerPoints = $this->scoreCollector->getByPlayer($playerNumberOne->nick);
        $secondPlayerPoints = $this->scoreCollector->getByPlayer($playerNumberTwo->nick);

        return $this->gameMode->prepareMessageFromMatchPoints($firstPlayerPoints, $secondPlayerPoints);
    }

    /**
     * @throws GameIsNotConfigured
     */
    public function wonPoint(string $playerNick): void
    {
        $this->checkIfGameIsConfigured();

        $this->scoreCollector->addPointToPlayer($playerNick);
    }

    /**
     * @throws GameIsNotConfigured
     */
    private function checkIfGameIsConfigured(): void
    {
        if (!isset($this->gameMode)) {
            throw GameIsNotConfigured::create();
        }
    }
}
