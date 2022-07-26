<?php

declare(strict_types=1);


namespace TennisGame\Domain\Specification;

use TennisGame\Domain\Model\MatchScore;

final class GameMidMessageGenerationSpecification extends GamePointsMessageGenerationStatementSpecification
    implements GamePointsMessageGenerationStrategySpecification
{
    public function isSatisfiedWhen(MatchScore $firstPlayerPoints, MatchScore $secondPlayerPoints): bool
    {
        return $firstPlayerPoints->amount >= 4 || $secondPlayerPoints->amount >= 4;
    }
}
