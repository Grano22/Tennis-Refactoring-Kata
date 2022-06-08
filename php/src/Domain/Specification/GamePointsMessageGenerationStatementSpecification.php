<?php

declare(strict_types=1);


namespace TennisGame\Domain\Specification;

use TennisGame\Domain\Rules\GamePointsMessageCompleteSpecification;

abstract class GamePointsMessageGenerationStatementSpecification implements GamePointsMessageGenerationStrategySpecification
{
    abstract public function isSatisfiedWhen(int $firstPlayerPoints, int $secondPlayerPoints): bool;

    public function isSatisfiedBy(int $firstPlayerPoints, int $secondPlayerPoints): GamePointsMessageCompleteSpecification
    {
        return $this->isSatisfiedWhen($firstPlayerPoints, $secondPlayerPoints) ?
            GamePointsMessageCompleteSpecification::asSatisfied($this) :
            GamePointsMessageCompleteSpecification::asUnsatisfied($this);
    }
}
