<?php

declare(strict_types=1);


namespace TennisGame\Application\Composite;

use TennisGame\Domain\Model\MatchScore;
use TennisGame\Domain\Rules\GamePointsMessageCompleteSpecification;
use TennisGame\Domain\Specification\GamePointsMessageGenerationStatementSpecification;
use TennisGame\Domain\Specification\GamePointsMessageGenerationStrategySpecification;

final class GamePointsMessageCompositeSpecification implements GamePointsMessageGenerationStrategySpecification
{
    /**
     * @var GamePointsMessageGenerationStatementSpecification[] $specifications
     */
    private readonly array $specifications;

    public static function createWithSubSpecList(
        GamePointsMessageGenerationStatementSpecification ...$specifications
    ): self {
        return new self(...$specifications);
    }

    private function __construct(GamePointsMessageGenerationStatementSpecification ...$specifications)
    {
        $this->specifications = $specifications;
    }

    public function isSatisfiedBy(MatchScore $firstPlayerPoints, MatchScore $secondPlayerPoints): GamePointsMessageCompleteSpecification
    {
        $specCompleteDetails = GamePointsMessageCompleteSpecification::asCompound($this);

        foreach ($this->specifications as $specification) {
            $specDetails = $specification->isSatisfiedBy($firstPlayerPoints, $secondPlayerPoints);
            $specCompleteDetails->extendSpecification($specDetails);
        }

        return $specCompleteDetails;
    }
}
