<?php

declare(strict_types=1);


namespace TennisGame\Domain\Specification;

use TennisGame\Domain\Model\MatchScore;
use TennisGame\Domain\Rules\GamePointsMessageCompleteSpecification;

abstract class GamePointsMessageGenerationStatementSpecification implements GamePointsMessageGenerationStrategySpecification
{
    abstract public function isSatisfiedWhen(MatchScore $firstPlayerPoints, MatchScore $secondPlayerPoints): bool;

    public function isSatisfiedBy(
        MatchScore $firstPlayerPoints,
        MatchScore $secondPlayerPoints
    ): GamePointsMessageCompleteSpecification {
        return $this->isSatisfiedWhen($firstPlayerPoints, $secondPlayerPoints) ?
            GamePointsMessageCompleteSpecification::asSatisfied($this) :
            GamePointsMessageCompleteSpecification::asUnsatisfied($this);
    }
}
