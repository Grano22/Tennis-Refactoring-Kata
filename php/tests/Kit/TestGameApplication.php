<?php

declare(strict_types=1);


namespace Tests\Kit;

use TennisGame\Application\AggregateRoot\ScoreCollector;
use TennisGame\Application\AggregateRoot\TennisGameNumberOne;
use TennisGame\Application\Factory\GameModeFactory;
use TennisGame\Application\Repository\InMemoryPlayerRepository;
use TennisGame\Application\Repository\PlayerRepository;
use TennisGame\Application\Service\PlayerRegistration;
use TennisGame\Domain\Policy\PlayerRegistrationPolicy;
use TennisGame\TennisGameApplication;

final class TestGameApplication
{
    public readonly PlayerRepository $playersRepository;
    protected readonly TennisGameApplication $gameApplication;

    public function __construct() {
        $this->playersRepository = new InMemoryPlayerRepository();
    }

    public function getGameApplication(): TennisGameApplication
    {
        if (!isset($this->gameApplication)) {
            $this->gameApplication = new TennisGameApplication(
                new PlayerRegistration(
                    new PlayerRegistrationPolicy($this->playersRepository),
                    $this->playersRepository
                ),
                $this->playersRepository,
                new ScoreCollector(),
                new GameModeFactory()
            );
        }

        return $this->gameApplication;
    }
}
