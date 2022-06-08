<?php

namespace TennisGame\Domain\Specification;

use TennisGame\Domain\Rules\GamePointsMessageCompleteSpecification;

interface GamePointsMessageGenerationStrategySpecification
{
    public function isSatisfiedBy(int $firstPlayerPoints, int $secondPlayerPoints): GamePointsMessageCompleteSpecification;
}