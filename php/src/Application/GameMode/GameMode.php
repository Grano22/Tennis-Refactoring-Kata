<?php

declare(strict_types=1);


namespace TennisGame\Application\GameMode;

use TennisGame\Application\Composite\GamePointsMessageCompositeSpecification;
use TennisGame\Application\Composite\GamePointsMessageStrategyComposite;
use TennisGame\Application\Strategy\GamerPointsMessageGenerationStrategy;
use TennisGame\Domain\Specification\GamePointsMessageGenerationStatementSpecification;

abstract class GameMode
{
    /**
     * @return GamerPointsMessageGenerationStrategy[]
     */
    protected abstract function registerMatchScoreMessageGenerationStrategies(): array;

    /**
     * @return GamePointsMessageGenerationStatementSpecification[]
     */
    protected abstract function registerMatchScoreMessageGenerationSpecifications(): array;

    public function prepareMessageFromMatchPoints(int $firstPlayerPoints, int $secondPlayerPoints): string
    {
        $specificationDetails = GamePointsMessageCompositeSpecification::createWithSubSpecList(
            ...$this->registerMatchScoreMessageGenerationSpecifications()
        )
            ->isSatisfiedBy($firstPlayerPoints, $secondPlayerPoints);

        return GamePointsMessageStrategyComposite::withStrategies(
            ...$this->registerMatchScoreMessageGenerationStrategies()
        )
            ->produceMessageFromStrategiesWhichSupportSpecification(
                $specificationDetails,
                $firstPlayerPoints,
                $secondPlayerPoints
            );
    }
}
