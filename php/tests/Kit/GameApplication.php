<?php

declare(strict_types=1);


namespace Tests\Kit;

use TennisGame\Application\Repository\InMemoryPlayerRepository;
use TennisGame\Application\Repository\PlayersRepository;
use TennisGame\Domain\Policy\PlayerRegistrationPolicy;
use TennisGame\TennisGame1;

final class GameApplication
{
    public readonly PlayersRepository $playersRepository;

    public function __construct() {
        $this->playersRepository = new InMemoryPlayerRepository();
    }

    public function createTennisGameNumberOne(string $firstPlayerNick, string $secondPlayerNick): TennisGame1
    {
        $this->playersRepository->clear();

        return new TennisGame1(
            new PlayerRegistrationPolicy($this->playersRepository),
            $this->playersRepository,
            $firstPlayerNick,
            $secondPlayerNick
        );
    }
}
