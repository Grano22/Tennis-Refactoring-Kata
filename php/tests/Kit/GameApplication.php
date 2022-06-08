<?php

declare(strict_types=1);


namespace Tests\Kit;

use TennisGame\Application\AggregateRoot\ScoreCollector;
use TennisGame\Application\AggregateRoot\TennisGameNumberOne;
use TennisGame\Application\Repository\InMemoryPlayerRepository;
use TennisGame\Application\Repository\PlayersRepository;
use TennisGame\Domain\Policy\PlayerRegistrationPolicy;

final class GameApplication
{
    public readonly PlayersRepository $playersRepository;

    public function __construct() {
        $this->playersRepository = new InMemoryPlayerRepository();
    }

    public function createTennisGameNumberOne(string $firstPlayerNick, string $secondPlayerNick): TennisGameNumberOne
    {
        $this->playersRepository->clear();

        return new TennisGameNumberOne(
            new PlayerRegistrationPolicy($this->playersRepository),
            $this->playersRepository,
            new ScoreCollector(),
            $firstPlayerNick,
            $secondPlayerNick
        );
    }
}
