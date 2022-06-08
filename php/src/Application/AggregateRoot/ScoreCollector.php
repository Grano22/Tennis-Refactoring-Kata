<?php

declare(strict_types=1);


namespace TennisGame\Application\AggregateRoot;

use TennisGame\Domain\Exception\PlayerDoNotHaveInitializedScore;

final class ScoreCollector
{
    /**
     * @var int[] $playersScore
     */
    private array $playersScore = [];

    public function initiateForPlayer(string $playerNick): void
    {
        $this->playersScore[$playerNick] = 0;
    }

    /**
     * @throws PlayerDoNotHaveInitializedScore
     */
    public function addPointToPlayer(string $playerNick): void
    {
        if (!$this->playerHaveInitializedScore($playerNick)) {
            throw PlayerDoNotHaveInitializedScore::forGivenNick($playerNick);
        }

        $this->playersScore[$playerNick] += 1;
    }

    /**
     * @throws PlayerDoNotHaveInitializedScore
     */
    public function getByPlayer(string $playerNick): int
    {
        if (!$this->playerHaveInitializedScore($playerNick)) {
            throw PlayerDoNotHaveInitializedScore::forGivenNick($playerNick);
        }

        return $this->playersScore[$playerNick];
    }

    private function playerHaveInitializedScore(string $playerNick): bool
    {
        return array_key_exists($playerNick, $this->playersScore);
    }
}
