<?php

declare(strict_types=1);


namespace TennisGame\Domain\Collection;

use JetBrains\PhpStorm\Immutable;
use TennisGame\Domain\Entity\Player;

#[Immutable]
final class PlayerCollection extends Collection
{
    public function __construct(Player ...$players) {
        parent::__construct($players);
    }
}
