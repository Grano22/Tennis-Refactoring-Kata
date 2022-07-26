<?php

declare(strict_types=1);


namespace TennisGame\Application\Strategy;

use TennisGame\Application\Visitor\GamePointsSpecificationCheckerVisitor;
use TennisGame\Domain\Model\MatchScore;
use TennisGame\Domain\Rules\GamePointsMessageCompleteSpecification;
use TennisGame\Domain\Specification\GameDefaultScoreGenerationSpecification;
use TennisGame\Domain\Specification\GameMidMessageGenerationSpecification;

final class GameMidPointsMessageGenerationStrategy implements GamerPointsMessageGenerationStrategy
{
    public function makeMessage(MatchScore $firstPlayerPoints, MatchScore $secondPlayerPoints): string
    {
        $minusResult = $firstPlayerPoints->amount - $secondPlayerPoints->amount;

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
        $checkerVisitor = new GamePointsSpecificationCheckerVisitor(
            GamePointsSpecificationCheckerVisitor::ONLY_AS_FIRST_SPECIFICATION_MUST_BE_SATISFIED,
            GameMidMessageGenerationSpecification::class
        );

        return $passedSpecifications->checkSpecification($checkerVisitor);
    }
}
