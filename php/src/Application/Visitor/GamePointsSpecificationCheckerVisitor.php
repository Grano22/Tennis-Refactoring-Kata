<?php

declare(strict_types=1);


namespace TennisGame\Application\Visitor;

use TennisGame\Application\Strategy\GamePointsAsFirstSpecificationSatisfiedCheckerStrategy;
use TennisGame\Application\Strategy\GamePointsOnlyFirstSpecificationSatisfiedCheckerStrategy;
use TennisGame\Application\Strategy\GamePointsOnlyOneSpecificationSatisfiedCheckerStrategy;
use TennisGame\Application\Strategy\GamePointsSpecificationCheckerStrategy;
use TennisGame\Domain\Rules\GamePointsMessageCompleteSpecification;

final class GamePointsSpecificationCheckerVisitor
{
    public const ONLY_FIRST_OCCUR_SPECIFICATION_MUST_BE_SATISFIED =
        GamePointsOnlyFirstSpecificationSatisfiedCheckerStrategy::class;
    public const ONLY_ONE_SPECIFICATION_MUST_BE_SATISFIED =
        GamePointsOnlyOneSpecificationSatisfiedCheckerStrategy::class;
    public const ONLY_AS_FIRST_SPECIFICATION_MUST_BE_SATISFIED =
        GamePointsAsFirstSpecificationSatisfiedCheckerStrategy::class;

    private bool $passed;

    public function __construct(
        private readonly string $checkerCriteriaMode,
        private readonly string $specificationType
    ) {
    }

    /**
     * @param GamePointsMessageCompleteSpecification[] $relatedSpecification
     */
    public function checkCriteria(array $relatedSpecification): void
    {
        /** @var GamePointsSpecificationCheckerStrategy $checker */
        $checker = new ($this->checkerCriteriaMode)();

        $this->passed = $checker->check($this->specificationType, $relatedSpecification);
    }

    public function isExpectationComeTrue(): bool
    {
        return $this->passed;
    }
}
