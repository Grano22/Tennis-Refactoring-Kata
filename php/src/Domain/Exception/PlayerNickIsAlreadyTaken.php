<?php

declare(strict_types=1);


namespace TennisGame\Domain\Exception;

use RuntimeException;

final class PlayerNickIsAlreadyTaken extends RuntimeException implements DomainException
{
    public static function create(string $details): self
    {
        return new self($details);
    }

    public static function forGivenNick(string $nick): self
    {
        return self::create("$nick is already taken");
    }

    private function __construct(string $details) { parent::__construct($details); }
}
