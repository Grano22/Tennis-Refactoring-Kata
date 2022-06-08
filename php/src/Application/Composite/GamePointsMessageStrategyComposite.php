<?php

declare(strict_types=1);


namespace TennisGame\Application\Composite;

use TennisGame\Application\Strategy\GameDefaultPointsMessageGenerationStrategy;
use TennisGame\Application\Strategy\GameDrawPointsMessageGenerationStrategy;
use TennisGame\Application\Strategy\GameMidPointsMessageGenerationStrategy;
use TennisGame\Application\Strategy\GamerPointsMessageGenerationStrategy;
use TennisGame\Domain\Rules\GamePointsMessageCompleteSpecification;

final class GamePointsMessageStrategyComposite
{
    /**
     * @var GamerPointsMessageGenerationStrategy[] $strategies
     */
    private readonly array $strategies;

    public function __construct()
    {
        $this->strategies = [
            new GameDrawPointsMessageGenerationStrategy(),
            new GameMidPointsMessageGenerationStrategy(),
            new GameDefaultPointsMessageGenerationStrategy()
        ];
    }

    public function produceMessageFromStrategiesWhichSupportSpecification(
        GamePointsMessageCompleteSpecification $specDetails,
        int $firstPlayerPoints,
        int $secondPlayerPoints
    ): string {
        $messageParts = [];

        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($specDetails)) {
                $messageParts[] = $strategy->makeMessage($firstPlayerPoints, $secondPlayerPoints);
            }
        }

        return implode(' ', $messageParts);
    }
}
