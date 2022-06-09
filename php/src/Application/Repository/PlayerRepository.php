<?php

namespace TennisGame\Application\Repository;

use TennisGame\Domain\Collection\PlayerCollection;
use TennisGame\Domain\Entity\Player;

interface PlayerRepository
{
    public function hasWithNick(string $nick): bool;
    public function store(string $nick): void;
    public function findByNick(string $nick): Player;
    public function findAll(): PlayerCollection;
    public function clear(): void;
}
