<?php

declare(strict_types=1);


namespace TennisGame\Application\Strategy;

use TennisGame\Application\Visitor\GamePointsSpecificationCheckerVisitor;
use TennisGame\Domain\Model\MatchScore;
use TennisGame\Domain\Rules\GamePointsMessageCompleteSpecification;
use TennisGame\Domain\Specification\GameDrawMessageGenerationSpecification;

final class GameDrawPointsMessageGenerationStrategy implements GamerPointsMessageGenerationStrategy
{
    public function makeMessage(MatchScore $firstPlayerPoints, MatchScore $secondPlayerPoints): string
    {
        return match ($firstPlayerPoints->amount) {
            0 => "Love-All",
            1 => "Fifteen-All",
            2 => "Thirty-All",
            default => "Deuce",
        };
    }

    public function supports(GamePointsMessageCompleteSpecification $passedSpecifications): bool
    {
        $checkerVisitor = new GamePointsSpecificationCheckerVisitor(
            GamePointsSpecificationCheckerVisitor::ONLY_AS_FIRST_SPECIFICATION_MUST_BE_SATISFIED,
            GameDrawMessageGenerationSpecification::class
        );

        return $passedSpecifications->checkSpecification($checkerVisitor);
    }
}
