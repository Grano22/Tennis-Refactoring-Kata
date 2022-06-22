<?php

declare(strict_types=1);


namespace TennisGame\Domain\Exception;

use RuntimeException;

final class UnsupportedGameMode extends RuntimeException implements DomainException
{
    public static function create(string $details): self
    {
        return new self('Game mode with name ' . $details . ' is unsupported');
    }

    private function __construct(string $details) { parent::__construct($details); }
}
