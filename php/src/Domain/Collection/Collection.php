<?php

declare(strict_types=1);

namespace TennisGame\Domain\Collection;

use ArrayIterator;
use Countable;
use IteratorAggregate;

/**
 * @template TValue
 * @psalm-template TValue
 * @phpstan-template TValue
 * @psalm-immutable
 *
 * @implements IteratorAggregate<int, TValue>
 * @see https://youtrack.jetbrains.com/issue/WI-62386 - it's about my prevous problem :)
 */
abstract class Collection implements Countable, IteratorAggregate
{
    /**
     * @var array<int, TValue> $items
     * @internal
     */
    protected readonly array $items;

    /**
     * @param TValue[] $items
     */
    protected function __construct(array $items) {
        $this->items = $items;
    }

    /**
     * @return ArrayIterator<int, TValue>
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    public function count(): int
    {
        return count($this->items);
    }

    /**
     * @return TValue[]
     */
    public function toArray(): array
    {
        return $this->items;
    }
}
