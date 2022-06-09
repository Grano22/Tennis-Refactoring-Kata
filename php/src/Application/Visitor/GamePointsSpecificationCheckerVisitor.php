<?php

declare(strict_types=1);


namespace TennisGame\Application\Visitor;

use TennisGame\Application\Strategy\GamePointsAsFirstSpecificationSatisfiedCheckerStrategy;
use TennisGame\Application\Strategy\GamePointsOnlyFirstSpecificationSatisfiedCheckerStrategy;
use TennisGame\Application\Strategy\GamePointsOnlyOneSpecificationSatisfiedCheckerStrategy;

final class GamePointsSpecificationCheckerVisitor
{
    public const ONLY_FIRST_OCCUR_SPECIFICATION_MUST_BE_SATISFIED = GamePointsOnlyFirstSpecificationSatisfiedCheckerStrategy::class;
    public const ONLY_ONE_SPECIFICATION_MUST_BE_SATISFIED = GamePointsOnlyOneSpecificationSatisfiedCheckerStrategy::class;
    public const ONLY_AS_FIRST_SPECIFICATION_MUST_BE_SATISFIED = GamePointsAsFirstSpecificationSatisfiedCheckerStrategy::class;

    private bool $passed;

    public function __construct(private string $checkerCriteriaMode, private string $specificationType)
    {
    }

    public function checkCriteria(array $relatedSpecification): void
    {
        $checker = new ($this->checkerCriteriaMode)();

        $this->passed = $checker->check($this->specificationType, $relatedSpecification);
    }

    public function isExpectationMeeted(): bool
    {
        return $this->passed;
    }
}
