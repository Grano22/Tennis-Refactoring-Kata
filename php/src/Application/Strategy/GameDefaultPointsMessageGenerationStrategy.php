<?php

declare(strict_types=1);


namespace TennisGame\Application\Strategy;

use TennisGame\Application\Visitor\GamePointsSpecificationCheckerVisitor;
use TennisGame\Domain\Model\MatchScore;
use TennisGame\Domain\Rules\GamePointsMessageCompleteSpecification;
use TennisGame\Domain\Specification\GameDefaultScoreGenerationSpecification;

final class GameDefaultPointsMessageGenerationStrategy implements GamerPointsMessageGenerationStrategy
{
    public function makeMessage(MatchScore $firstPlayerPoints, MatchScore $secondPlayerPoints): string
    {
        return sprintf(
            '%s-%s',
            $this->scoreValueToName($firstPlayerPoints->amount),
            $this->scoreValueToName($secondPlayerPoints->amount)
        );
    }

    private function scoreValueToName(int $score): string
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
        $checkerVisitor = new GamePointsSpecificationCheckerVisitor(
            GamePointsSpecificationCheckerVisitor::ONLY_AS_FIRST_SPECIFICATION_MUST_BE_SATISFIED,
            GameDefaultScoreGenerationSpecification::class
        );

        return $passedSpecifications->checkSpecification($checkerVisitor);
    }
}
