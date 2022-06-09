<?php

declare(strict_types=1);


namespace TennisGame\Domain\Rules;

use RuntimeException;
use TennisGame\Application\Visitor\GamePointsSpecificationCheckerVisitor;
use TennisGame\Domain\Specification\GamePointsMessageGenerationStrategySpecification;

final class GamePointsMessageCompleteSpecification
{
    private bool $completion;

    /** @var GamePointsMessageCompleteSpecification[] $relatedSpecifications */
    private array $relatedSpecifications;

    public static function asSatisfied(GamePointsMessageGenerationStrategySpecification $specification): self
    {
        return (new self($specification::class))->markSpecificationCompletion(true);
    }

    public static function asUnsatisfied(GamePointsMessageGenerationStrategySpecification $specification): self
    {
        return (new self($specification::class))->markSpecificationCompletion(false);
    }

    public static function asCompound(GamePointsMessageGenerationStrategySpecification $specification): self
    {
        return new self($specification::class);
    }

    private function __construct(private readonly string $specificationClass)
    {
    }

    public function isSatisfied(): bool
    {
        if (!isset($this->completion)) {
            throw new RuntimeException('Cannot get completion of specification');
        }

        return $this->completion;
    }

    public function getSpecificationType(): string
    {
        return $this->specificationClass;
    }

    public function checkSpecification(GamePointsSpecificationCheckerVisitor &$checkerVisitor): bool
    {
        $checkerVisitor->checkCriteria($this->relatedSpecifications);

        return $checkerVisitor->isExpectationMeeted();
    }

    public function extendSpecification(GamePointsMessageCompleteSpecification $anotherSpec): self {
        if (isset($this->completion)) {
            throw new RuntimeException('Cannot extend specification when is finished');
        }

        $this->relatedSpecifications[] = $anotherSpec;

        return $this;
    }

    public function markSpecificationCompletion(bool $completion): self
    {
        if (isset($this->completion)) {
            throw new RuntimeException('Cannot mark specification when is finished');
        }

        $this->completion = $completion;

        return $this;
    }
}
