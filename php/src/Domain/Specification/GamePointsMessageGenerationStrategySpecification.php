<?php

namespace TennisGame\Domain\Specification;

use TennisGame\Domain\Model\MatchScore;
use TennisGame\Domain\Rules\GamePointsMessageCompleteSpecification;

interface GamePointsMessageGenerationStrategySpecification
{
    public function isSatisfiedBy(
        MatchScore $firstPlayerPoints,
        MatchScore $secondPlayerPoints
    ): GamePointsMessageCompleteSpecification;
}