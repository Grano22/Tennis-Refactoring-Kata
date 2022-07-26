<?php

declare(strict_types=1);


namespace TennisGame\Domain\Specification;

use TennisGame\Domain\Model\MatchScore;

final class GameDefaultScoreGenerationSpecification extends GamePointsMessageGenerationStatementSpecification
{
    public function isSatisfiedWhen(MatchScore $firstPlayerPoints, MatchScore $secondPlayerPoints): bool
    {
        return true;
    }
}
