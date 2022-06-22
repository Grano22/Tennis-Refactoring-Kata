<?php

declare(strict_types=1);


namespace TennisGame\Domain\Collection;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use JetBrains\PhpStorm\Immutable;

#[Immutable]
/**
 * @template T
 *
 * @implements IteratorAggregate<int, T>
 */
abstract class Collection implements Countable, IteratorAggregate
{
    /**
     * @var T[] $items
     */
    protected readonly array $items;

    /**
     * @param T[] $items
     */
    protected function __construct(array $items) {
        $this->items = $items;
    }

    /**
     * @return ArrayIterator<int, T>
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
     * @return T[]
     */
    public function toArray(): array
    {
        return $this->items;
    }
}
