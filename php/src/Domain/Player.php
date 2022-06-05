<?php

declare(strict_types=1);


namespace TennisGame\Domain;

use JetBrains\PhpStorm\Immutable;

#[Immutable]
final class Player
{
    public function __construct(public readonly string $nick) {

    }
}
