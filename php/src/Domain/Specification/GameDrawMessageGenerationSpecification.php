<?php

declare(strict_types=1);


namespace TennisGame\Domain\Specification;

use TennisGame\Domain\Model\MatchScore;

final class GameDrawMessageGenerationSpecification extends GamePointsMessageGenerationStatementSpecification implements GamePointsMessageGenerationStrategySpecification
{
    public function isSatisfiedWhen(MatchScore $firstPlayerPoints, MatchScore $secondPlayerPoints): bool
    {
        return $firstPlayerPoints->amount === $secondPlayerPoints->amount;
    }
}
