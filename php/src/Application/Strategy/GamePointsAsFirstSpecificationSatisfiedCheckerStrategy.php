<?php

declare(strict_types=1);


namespace TennisGame\Application\Strategy;

final class GamePointsAsFirstSpecificationSatisfiedCheckerStrategy implements GamePointsSpecificationCheckerStrategy
{
    public function check(string $specificationType, array $relatedSpecifications): bool
    {
        foreach ($relatedSpecifications as $relatedSpecification)
        {
            if ($relatedSpecification->isSatisfied())
            {
                return $relatedSpecification->getSpecificationType() === $specificationType;
            }
        }

        return false;
    }
}
