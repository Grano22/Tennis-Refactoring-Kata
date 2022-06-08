<?php

declare(strict_types=1);


namespace TennisGame\Domain\Specification;

final class GameMidMessageGenerationSpecification extends GamePointsMessageGenerationStatementSpecification implements GamePointsMessageGenerationStrategySpecification
{
    public function isSatisfiedWhen(int $firstPlayerPoints, int $secondPlayerPoints): bool
    {
        return $firstPlayerPoints >= 4 || $secondPlayerPoints >= 4;
    }
}
