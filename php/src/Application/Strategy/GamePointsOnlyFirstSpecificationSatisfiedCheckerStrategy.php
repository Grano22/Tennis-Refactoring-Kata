<?php

declare(strict_types=1);


namespace TennisGame\Application\Strategy;

final class GamePointsOnlyFirstSpecificationSatisfiedCheckerStrategy implements GamePointsSpecificationCheckerStrategy
{

    public function check(string $specificationType, array $relatedSpecifications): bool
    {
        foreach ($relatedSpecifications as $relatedSpecification)
        {
            if (
                $relatedSpecification->isSatisfied() &&
                $relatedSpecification->getSpecificationType() !== $specificationType
            ) {
                return false;
            }
        }

        return (new GamePointsOnlyOneSpecificationSatisfiedCheckerStrategy())
            ->check($specificationType, $relatedSpecifications);
    }
}
