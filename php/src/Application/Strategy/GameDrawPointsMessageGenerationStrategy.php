<?php

declare(strict_types=1);


namespace TennisGame\Application\Strategy;

use TennisGame\Domain\Rules\GamePointsMessageCompleteSpecification;
use TennisGame\Domain\Specification\GameDrawMessageGenerationSpecification;

final class GameDrawPointsMessageGenerationStrategy implements GamerPointsMessageGenerationStrategy
{
    public function makeMessage(int $firstPlayerPoints, int $secondPlayerPoints): string
    {
        return match ($firstPlayerPoints) {
            0 => "Love-All",
            1 => "Fifteen-All",
            2 => "Thirty-All",
            default => "Deuce",
        };
    }

    public function supports(GamePointsMessageCompleteSpecification $passedSpecifications): bool
    {
        return $passedSpecifications
            ->isSatisfiedByAsFirstRelatedSpecificationType(GameDrawMessageGenerationSpecification::class);
    }
}
