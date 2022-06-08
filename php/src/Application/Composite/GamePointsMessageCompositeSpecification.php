<?php

declare(strict_types=1);


namespace TennisGame\Application\Composite;

use JetBrains\PhpStorm\ArrayShape;
use TennisGame\Domain\Rules\GamePointsMessageCompleteSpecification;
use TennisGame\Domain\Specification\GameDefaultScoreGenerationSpecification;
use TennisGame\Domain\Specification\GameDrawMessageGenerationSpecification;
use TennisGame\Domain\Specification\GameMidMessageGenerationSpecification;
use TennisGame\Domain\Specification\GamePointsMessageGenerationStatementSpecification;
use TennisGame\Domain\Specification\GamePointsMessageGenerationStrategySpecification;

final class GamePointsMessageCompositeSpecification implements GamePointsMessageGenerationStrategySpecification
{
    /**
     * @var GamePointsMessageGenerationStatementSpecification[] $specifications
     */
    private readonly array $specifications;

    public function __construct()
    {
        $this->specifications = [
            new GameDrawMessageGenerationSpecification(),
            new GameMidMessageGenerationSpecification(),
            new GameDefaultScoreGenerationSpecification(),
        ];
    }

    public function isSatisfiedBy(int $firstPlayerPoints, int $secondPlayerPoints): GamePointsMessageCompleteSpecification
    {
        $specCompleteDetails = GamePointsMessageCompleteSpecification::asCompound($this);

        foreach ($this->specifications as $specification) {
            $specDetails = $specification->isSatisfiedBy($firstPlayerPoints, $secondPlayerPoints);
            $specCompleteDetails->extendSpecification($specDetails);
        }

        return $specCompleteDetails;
    }
}
