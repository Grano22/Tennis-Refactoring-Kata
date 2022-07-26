<?php

declare(strict_types=1);

namespace TennisGame\Domain\Model;

final class MatchScore
{
    public function __construct(
        public readonly int $amount
    ) {
    }

    public function add(int $amount): MatchScore
    {
        return new self($this->amount + $amount);
    }
}
