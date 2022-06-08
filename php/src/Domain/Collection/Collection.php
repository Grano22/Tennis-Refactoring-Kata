<?php

declare(strict_types=1);


namespace TennisGame\Domain\Collection;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use JetBrains\PhpStorm\Immutable;

#[Immutable]
abstract class Collection implements Countable, IteratorAggregate
{
    protected readonly array $items;

    protected function __construct($items) {
        $this->items = $items;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function toArray(): array
    {
        return $this->items;
    }
}
