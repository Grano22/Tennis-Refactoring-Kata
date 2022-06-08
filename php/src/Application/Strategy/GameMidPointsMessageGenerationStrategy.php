<?php

declare(strict_types=1);


namespace TennisGame\Application\Strategy;

use TennisGame\Domain\Rules\GamePointsMessageCompleteSpecification;
use TennisGame\Domain\Specification\GameMidMessageGenerationSpecification;

final class GameMidPointsMessageGenerationStrategy implements GamerPointsMessageGenerationStrategy
{
    public function makeMessage(int $firstPlayerPoints, int $secondPlayerPoints): string
    {
        $minusResult = $firstPlayerPoints - $secondPlayerPoints;

        if ($minusResult === 1) {
            return "Advantage player1";
        }

        if ($minusResult === -1) {
            return "Advantage player2";
        }

        if ($minusResult >= 2) {
           return  "Win for player1";
        }

        return "Win for player2";
    }

    public function supports(GamePointsMessageCompleteSpecification $passedSpecifications): bool
    {
        return $passedSpecifications
            ->isSatisfiedByAsFirstRelatedSpecificationType(GameMidMessageGenerationSpecification::class);
    }
}
