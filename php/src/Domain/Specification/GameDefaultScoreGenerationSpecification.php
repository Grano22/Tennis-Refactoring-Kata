<?php

declare(strict_types=1);


namespace TennisGame\Domain\Specification;

final class GameDefaultScoreGenerationSpecification extends GamePointsMessageGenerationStatementSpecification
{
    public function isSatisfiedWhen(int $firstPlayerPoints, int $secondPlayerPoints): bool
    {
        return true;
    }
}
