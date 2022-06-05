<?php

namespace TennisGame\Application\Repository;

use TennisGame\Domain\Player;

interface PlayersRepository
{
    public function hasWithNick(string $nick): bool;
    public function store(string $nick): void;
    public function findByNick(string $nick): Player;
    public function clear(): void;
}
