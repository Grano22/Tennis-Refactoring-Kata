<?php

namespace TennisGame\Application\Strategy;

use TennisGame\Domain\Rules\GamePointsMessageCompleteSpecification;

interface GamePointsSpecificationCheckerStrategy
{
    /**
     * @param GamePointsMessageCompleteSpecification[] $relatedSpecifications
     */
    public function check(string $specificationType, array $relatedSpecifications): bool;
}
