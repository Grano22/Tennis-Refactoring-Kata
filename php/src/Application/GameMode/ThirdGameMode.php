<?php

declare(strict_types=1);


namespace TennisGame\Application\GameMode;

use TennisGame\Application\Strategy\GameDefaultPointsMessageGenerationStrategy;
use TennisGame\Application\Strategy\GameDrawPointsMessageGenerationStrategy;
use TennisGame\Application\Strategy\GameMidPointsMessageGenerationStrategy;
use TennisGame\Domain\Specification\GameDefaultScoreGenerationSpecification;
use TennisGame\Domain\Specification\GameDrawMessageGenerationSpecification;
use TennisGame\Domain\Specification\GameMidMessageGenerationSpecification;

final class ThirdGameMode extends GameMode
{
    public function registerMatchScoreMessageGenerationStrategies(): array
    {
        return [
            new GameDrawPointsMessageGenerationStrategy(),
            new GameMidPointsMessageGenerationStrategy(),
            new GameDefaultPointsMessageGenerationStrategy()
        ];
    }

    public function registerMatchScoreMessageGenerationSpecifications(): array
    {
        return [
            new GameDrawMessageGenerationSpecification(),
            new GameMidMessageGenerationSpecification(),
            new GameDefaultScoreGenerationSpecification(),
        ];
    }
}
