<?php

namespace TennisGame\Application\Strategy;

interface GamePointsSpecificationCheckerStrategy
{
    public function check(string $specificationType, array $relatedSpecifications): bool;
}
