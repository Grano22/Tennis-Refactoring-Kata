<?php

declare(strict_types=1);


namespace TennisGame\Domain\Rules;

use RuntimeException;
use TennisGame\Application\Visitor\GamePointsSpecificationCheckerVisitor;
use TennisGame\Domain\Specification\GamePointsMessageGenerationStrategySpecification;

final class GamePointsMessageCompleteSpecification
{
    /** @var GamePointsMessageCompleteSpecification[] $relatedSpecifications */
    private array $relatedSpecifications;

    public static function asSatisfied(GamePointsMessageGenerationStrategySpecification $specification): self
    {
        return new self($specification::class, true);
    }

    public static function asUnsatisfied(GamePointsMessageGenerationStrategySpecification $specification): self
    {
        return new self($specification::class, false);
    }

    public static function asCompound(GamePointsMessageGenerationStrategySpecification $specification): self
    {
        return new self($specification::class, null);
    }

    private function __construct(private readonly string $specificationClass, private readonly ?bool $completion)
    {
    }

    public function isSatisfied(): bool
    {
        $specificationSatisfaction = array_reduce(
            $this->relatedSpecifications,
            static fn(bool &$carry, GamePointsMessageCompleteSpecification $completeSpecification): bool =>
                $carry = $carry && $completeSpecification->isSatisfied(),
            true
        );

        return $this->completion === null ? $specificationSatisfaction : $this->completion;
    }

    public function getSpecificationType(): string
    {
        return $this->specificationClass;
    }

    public function checkSpecification(GamePointsSpecificationCheckerVisitor $checkerVisitor): bool
    {
        $checkerVisitor->checkCriteria($this->relatedSpecifications);

        return $checkerVisitor->isExpectationComeTrue();
    }

    public function extendSpecification(GamePointsMessageCompleteSpecification $anotherSpec): self {
        if (isset($this->completion)) {
            throw new RuntimeException('Cannot extend specification when is finished');
        }

        $this->relatedSpecifications[] = $anotherSpec;

        return $this;
    }
}
