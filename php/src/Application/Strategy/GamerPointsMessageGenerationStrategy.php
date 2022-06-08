<?php

namespace TennisGame\Application\Strategy;

use TennisGame\Domain\Rules\GamePointsMessageCompleteSpecification;

interface GamerPointsMessageGenerationStrategy
{
    public function makeMessage(int $firstPlayerPoints, int $secondPlayerPoints): string;
    public function supports(GamePointsMessageCompleteSpecification $passedSpecifications): bool;
}
