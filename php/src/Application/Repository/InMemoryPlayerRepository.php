<?php

declare(strict_types=1);


namespace TennisGame\Application\Repository;

use TennisGame\Domain\Collection\PlayerCollection;
use TennisGame\Domain\Entity\Player;
use TennisGame\Domain\Exception\PlayerNotFound;

final class InMemoryPlayerRepository implements PlayerRepository
{
    private array $registeredPlayers = [];

    public function hasWithNick(string $nick): bool
    {
        return array_key_exists($nick, $this->registeredPlayers);
    }

    public function store(string $nick): void
    {
        $this->registeredPlayers[$nick] = new Player($nick);
    }

    /**
     * @throws PlayerNotFound
     */
    public function findByNick(string $nick): Player
    {
        if (!$this->hasWithNick($nick)) {
            throw PlayerNotFound::forGivenNick($nick);
        }

        return $this->registeredPlayers[$nick];
    }

    public function clear(): void
    {
        $this->registeredPlayers = [];
    }

    public function findAll(): PlayerCollection
    {
        return new PlayerCollection(...array_values($this->registeredPlayers));
    }
}
