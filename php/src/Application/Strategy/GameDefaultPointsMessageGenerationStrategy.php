<?php

declare(strict_types=1);


namespace TennisGame\Application\Strategy;

use JetBrains\PhpStorm\Pure;
use TennisGame\Domain\Rules\GamePointsMessageCompleteSpecification;
use TennisGame\Domain\Specification\GameDefaultScoreGenerationSpecification;
use TennisGame\Domain\Specification\GamePointsMessageGenerationStatementSpecification;

final class GameDefaultPointsMessageGenerationStrategy implements GamerPointsMessageGenerationStrategy
{
    public function makeMessage(int $firstPlayerPoints, int $secondPlayerPoints): string
    {
        return sprintf(
            '%s-%s',
            $this->scoreToName($firstPlayerPoints),
            $this->scoreToName($secondPlayerPoints)
        );
    }

    private function scoreToName(int $score): string
    {
        return match($score) {
            0 => "Love",
            1 => "Fifteen",
            2 => "Thirty",
            3 => "Forty",
            default => ""
        };
    }

    public function supports(GamePointsMessageCompleteSpecification $passedSpecifications): bool
    {
        return $passedSpecifications->isSatisfiedByAsFirstRelatedSpecificationType(
            GameDefaultScoreGenerationSpecification::class
        );
    }
}
