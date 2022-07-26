<?php

namespace TennisGame\Application\Strategy;

use TennisGame\Domain\Model\MatchScore;
use TennisGame\Domain\Rules\GamePointsMessageCompleteSpecification;

interface GamerPointsMessageGenerationStrategy
{
    public function makeMessage(MatchScore $firstPlayerPoints, MatchScore $secondPlayerPoints): string;
    public function supports(GamePointsMessageCompleteSpecification $passedSpecifications): bool;
}
