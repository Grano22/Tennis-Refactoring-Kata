<?php

declare(strict_types=1);


namespace TennisGame\Application\Strategy;

final class GamePointsOnlyOneSpecificationSatisfiedCheckerStrategy implements GamePointsSpecificationCheckerStrategy
{

    public function check(string $specificationType, array $relatedSpecifications): bool
    {
        foreach ($relatedSpecifications as $relatedSpecification)
        {
            if ($relatedSpecification->getSpecificationType() === $specificationType)
            {
                return $relatedSpecification->isSatisfied();
            }
        }

        return false;
    }
}
